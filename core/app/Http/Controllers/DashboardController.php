<?php

namespace App\Http\Controllers;
use App\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['lunas'] = Event::where('status','lunas')->count();
        $data['menunggu'] = Event::where('status','menunggu-pembayaran')->count();

        // dd($data);
        return view('back.pages.dashboard.dashboard',$data);
    }

    public function kalender()
    {
        return view('back.pages.calendar');
    }

    public function getEvent()
    {
        $event = Event::all();
        $data = [];
        foreach($event as $key => $item){
            $data[$key]['title'] = $item->nama_klien . ' | ' . $item->lokasi->nama;
            $data[$key]['start'] = $item->tanggal_mulai;
            $data[$key]['end'] = $item->tanggal_selesai;
            $data[$key]['url'] = route('event.detail',$item->id);
        }
        return response()->json($data);
    }
}
