<?php

namespace App\Http\Controllers;

use App\Event;
use App\Lokasi;
use App\Lokasi_Gambar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $data['lokasi'] = Lokasi::orderBy('nama', 'asc')->get();
        return view('back.pages.lokasi.lokasi', $data);
    }

    public function add()
    {
        return view('back.pages.lokasi.lokasi_add');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $lokasi = new Lokasi();
        $lokasi->nama = $request->nama;
        $lokasi->harga = str_replace(".", "", $request->harga);
        $lokasi->deskripsi = $request->deskripsi;
        $lokasi->alamat = $request->alamat;
        $lokasi->kapasitas_parkir = $request->kapasitas;
        $lokasi->unit_display = $request->unit_display;
        $lokasi->kapasitas_tamu = $request->kapasitas_tamu;
        $lokasi->save();

        $count = count($request->img);
        $image = $request->file('img');
        $destinationPath = 'assets/lokasi_img/';

        // dd($count);

        for ($i = 0; $i < $count; $i++) {

            $galeri_foto = new Lokasi_Gambar();
            $galeri_foto->lokasi_id = $lokasi->id;

            $file = $image[$i];

            if ($file->isValid()) {
                $file_name = Str::slug($lokasi->nama) . $i . "-" . time() . "." . $file->getClientOriginalExtension();
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

        return redirect(route('lokasi'))->with('success', 'Data Berhasil disimpan');
    }

    public function detail($id)
    {
        $data['lokasi'] = Lokasi::findOrFail($id);
        $data['gambar'] = Lokasi_Gambar::where('lokasi_id', $data['lokasi']->id)->get();
        return view('back.pages.lokasi.lokasi_detail', $data);
    }

    public function destroy(Request $request)
    {
        $lokasi = Lokasi::find($request->id);
        $cek = Event::where('lokasi_id',$request->id)->count();
        
        if ($cek == 0) {
            $img = Lokasi_Gambar::where('lokasi_id', $lokasi->id);
            foreach ($img->get() as $item) {
                $imgPath = 'assets/lokasi_img/' . $item->image_name;
                if (is_file($imgPath)) {
                    unlink($imgPath);
                }
            }
            $img->delete();
            $lokasi->delete();
            return response()->json('oke');
        } else {
            return response()->json('no');
        }
    }
}
