<?php

namespace App\Http\Controllers;

use App\Event;
use App\Event_Gambar;
use App\Lokasi;
use App\Lokasi_Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
{
    public function index()
    {
        $data['lokasi'] = Lokasi::orderBy('nama', 'asc')->get();
        return view('back.pages.event.event_add', $data);
    }

    public function getDateDiff(Request $request)
    {

        if ($request->date_start == $request->date_end) {
            return response()->json(1);
        }

        $date1 = date_create($request->date_start);
        $date2 = date_create($request->date_end);
        $diff = date_diff($date1, $date2);
        $opr = $diff->format("%R%a")[0];
        $pecah = explode($opr, $diff->format("%R%a"));

        if ($opr == "-") {
            return response()->json('no-valid');
        } elseif ($opr == "+") {
            return response()->json($pecah[1] + 1);
        } else {
            return response()->json($opr);
        }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $lastId = Event::orderBy('id', 'desc');
        if (count($lastId->get()) == 0) {
            $lid = 0;
        } else {
            $lid = $lastId->first()->id;
        }
        // dd($lid);
        $kode = date('Ymd') . '-' . Str::random(4) . '-' . $lid;
        $event = new Event();
        $event->kode_event = $kode;
        $event->nama_klien = $request->nama;
        $event->tanggal_mulai = $request->date_start;
        $event->tanggal_selesai = $request->date_end;
        $event->total_hari =  $request->total_hari;
        $event->biaya_tempat = str_replace(".", "", $request->sewa_tempat);
        $event->lokasi_id = $request->lokasi_id;
        $event->mc = $request->mc;
        $event->jam_mulai = $request->jam_mulai;
        $event->jam_selesai = $request->jam_akhir;
        $event->rundown = $request->rundown_acara;
        $event->undian = $request->undian;
        $event->harga_undian = str_replace(".", "", $request->harga_undian);
        $event->harga_mc = str_replace(".", "", $request->mc_harga);
        $event->band = $request->band;
        $event->harga_band = str_replace(".", "", $request->band_harga);
        $event->makanan_per_porsi = str_replace(".", "", $request->makanan_per);
        $event->jml_porsi = str_replace(".", "", $request->jml_porsi);
        $event->eo = $request->eo;
        $event->harga_eo = str_replace(".", "", $request->harga_eo);
        $event->biaya_makanan = str_replace(".", "", $request->total_makanan);
        $event->total_budget = str_replace(".", "", $request->total_budget);
        $event->status = 'menunggu-pembayaran';

        if($request->hasFile('file_pendukung')){
            $file = $request->file('file_pendukung');
            $file_name = time().$file->getClientOriginalName();
            $file->move('assets/file_pendukung', $file_name);
            $event->file_pendukung = $file_name;
        }
        // die();
        // dd($event);
        $event->save();

        $count = count($request->img);
        $image = $request->file('img');
        $destinationPath = 'assets/event_img/';

        // dd($count);

        for ($i = 0; $i < $count; $i++) {

            $galeri_foto = new Event_Gambar();
            $galeri_foto->event_id = $event->id;

            $file = $image[$i];

            if ($file->isValid()) {
                $file_name = Str::slug($event->nama_klien) . $i . "-" . time() . "." . $file->getClientOriginalExtension();
                $target = $destinationPath . $file_name;
                Image::make($file->getRealPath())->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($target);
                $galeri_foto->image_name = $file_name;
                $galeri_foto->save();
            } else {
                // handle error here
            }
        }

        return redirect()->route('event')->with('success', 'Data Berhasil di simpan');
    }

    public function data($status)
    {
        $data['event'] = Event::where('status', $status)->orderBy('id', 'desc')->get();
        $data['status'] = $status;
        return view('back.pages.event.event', $data);
    }

    public function detail($id)
    {
        $event = Event::findOrFail($id);
        $e_gambar = Event_Gambar::where('event_id', $id)->get();
        $lokasi = Lokasi::where('id', $event->lokasi_id)->first();
        $gambar_lokasi = Lokasi_Gambar::where('lokasi_id', $lokasi->id)->get();
        $data['event'] = $event;
        $data['e_gambar'] = $e_gambar;
        $data['lokasi'] = $lokasi;
        $data['gambar_lokasi'] = $gambar_lokasi;
        return view('back.pages.event.event_detail', $data);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $data['lokasi'] = Lokasi::orderBy('nama', 'asc')->get();
        $data['event'] = $event;
        return view('back.pages.event.event_edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $event = Event::findOrFail($id);
        $event->nama_klien = $request->nama;
        $event->tanggal_mulai = $request->date_start;
        $event->tanggal_selesai = $request->date_end;
        $event->total_hari =  $request->total_hari;
        $event->biaya_tempat = str_replace(".", "", $request->sewa_tempat);
        $event->lokasi_id = $request->lokasi_id;
        $event->mc = $request->mc;
        $event->jam_mulai = $request->jam_mulai;
        $event->jam_selesai = $request->jam_akhir;
        $event->rundown = $request->rundown_acara;
        $event->undian = $request->undian;
        $event->harga_undian = str_replace(".", "", $request->harga_undian);
        $event->harga_mc = str_replace(".", "", $request->mc_harga);
        $event->band = $request->band;
        $event->harga_band = str_replace(".", "", $request->band_harga);
        $event->makanan_per_porsi = str_replace(".", "", $request->makanan_per);
        $event->jml_porsi = str_replace(".", "", $request->jml_porsi);
        $event->eo = $request->eo;
        $event->harga_eo = str_replace(".", "", $request->harga_eo);
        $event->biaya_makanan = str_replace(".", "", $request->total_makanan);
        $event->total_budget = str_replace(".", "", $request->total_budget);
        $event->status = $request->status;
        $event->save();

        if ($event->status == 'lunas') {
            return redirect()->route('event.data', 'lunas')->with('success', 'Data berhasil di ubah');
        }
        return redirect()->route('event.data', 'menunggu-pembayaran')->with('success', 'Data berhasil di ubah');
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        $event = Event::where('id',$request->id)->first();
        $cek = 0;
        if ($cek == 0) {
            $img = Event_Gambar::where('event_id', $event->id);
            foreach ($img->get() as $item) {
                $imgPath = 'assets/event_img/' . $item->image_name;
                if (is_file($imgPath)) {
                    unlink($imgPath);
                }
            }
            $img->delete();
            $event->delete();
            return response()->json('oke');
        } else {
            return response()->json('no');
        }
    }

    public function laporan()
    {
        return view('back.pages.event.laporan');
    }

    public function laporanCetak(Request $request)
    {
        // dd($request->all());
        $input = $request->tanggal;
        $pecah = explode(" - ", $input);
        $tanggal_awal = date('Y-m-d', strtotime($pecah[0]));
        $tanggal_akhir = date('Y-m-d', strtotime($pecah[1]));
        // dd($tanggal_awal);
        if($request->jenis == 'semua'){
            $event = Event::whereBetween('tanggal_mulai',[$tanggal_awal,$tanggal_akhir])->get();
        }else{
            $event = Event::where('status',$request->jenis)->whereBetween('tanggal_mulai',[$tanggal_awal,$tanggal_akhir])->get();
        }
        $data['periode'] = $request->tanggal;
        $data['event'] = $event;

        // dd($event);  
        return view('back.pages.event.cetak',$data);
    }
}
