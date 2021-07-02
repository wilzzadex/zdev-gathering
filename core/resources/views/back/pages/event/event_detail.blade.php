@extends('back.master')
{{-- @section('judul')
    Master Data / Data Lokasi
@endsection --}}
@section('custom-css')

@endsection
@section('content')
    <div class="row">

        <div class="col-12">

            <!-- Default Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary">Detail | {{ $event->kode_event }}</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table style="width:100%">
                                <tr>
                                    <td width="15%">Kode Event Gathering</td>
                                    <td width="5%">:</td>
                                    <th width="80%">{{ $event->kode_event }}</th>
                                </tr>
                                <tr>
                                    <td width="10%">Klien</td>
                                    <th>:</th>
                                    <th>{{ $event->nama_klien }}</th>
                                </tr>

                                <tr>
                                    <td width="10%">Lokasi</td>
                                    <th>:</th>
                                    <th>{{ $event->lokasi->nama }}</th>
                                </tr>
                                <tr>
                                    <td width="10%">Tanggal Acara</td>
                                    <th>:</th>
                                    <th>{{ date('d M Y', strtotime($event->tanggal_mulai)) }} s/d
                                        {{ date('d M Y', strtotime($event->tanggal_selesai)) }}
                                        ({{ $event->total_hari }}
                                        Hari)</th>
                                </tr>
                                <tr>
                                    <td width="15%">Waktu Acara</td>
                                    <td width="5%">:</td>
                                    <th width="80%">{{ date('H:i', strtotime($event->jam_mulai)) }} -
                                        {{ date('H:i', strtotime($event->jam_selesai)) }}</th>
                                </tr>
                                <tr>
                                    <td width="15%">Alamat</td>
                                    <td width="5%">:</td>
                                    <th width="80%">{{ $event->lokasi->alamat }}</th>
                                </tr>
                                <tr>
                                    <td width="15%">MC / Pembawa Acara</td>
                                    <td width="5%">:</td>
                                    <th width="80%">{{ $event->mc }}</th>
                                </tr>
                                <tr>
                                    <td width="15%">Band / Musik</td>
                                    <td width="5%">:</td>
                                    <th width="80%">{{ $event->band }}</th>
                                </tr>




                                <tr>
                                    <td colspan="3">
                                        <div class="row">

                                            {{-- @foreach ($gambar as $item)
                                                <div class="col-md-3">
                                                    <img src="{{ asset('assets/lokasi_img/' . $item->image_name) }}"
                                                        onclick="lihatGambar(this)" style="cursor: pointer"
                                                        class="img-thumbnail" width="350px" alt="">
                                                </div>
                                            @endforeach --}}

                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <div id="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse"
                                                data-target="#collapseOne_rundown" aria-expanded="true"
                                                aria-controls="collapseOne_rundown">
                                                Rundown Acara
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne_rundown" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{ $event->rundown }}
                                                </div>
                                                <div class="col-md-6">
                                                    <iframe id="fred" style="border:1px solid #666CCC"
                                                        title="PDF in an i-Frame"
                                                        src="{{ asset('assets/file_pendukung/' . $event->file_pendukung) }}"
                                                        frameborder="1" scrolling="auto" height="400" width="100%"></iframe>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_1"
                                                aria-expanded="true" aria-controls="collapseOne_1">
                                                Budget
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne_1" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <table style="width:100%">
                                                <tr>
                                                    <td width="15%">Sewa Tempat</td>
                                                    <td width="5%">:</td>
                                                    <th width="80%">Rp. {{ number_format($event->biaya_tempat) }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="15%">Mc</td>
                                                    <td width="5%">:</td>
                                                    <th width="80%">Rp. {{ number_format($event->harga_mc) }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="15%">Band / Musik</td>
                                                    <td width="5%">:</td>
                                                    <th width="80%">Rp. {{ number_format($event->harga_band) }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="15%">Makanan</td>
                                                    </td>
                                                    <td width="5%">:</td>
                                                    <th width="80%">1 Porsi Rp.
                                                        {{ number_format($event->makanan_per_porsi) }} x
                                                        {{ $event->jml_porsi }} = Rp.
                                                        {{ number_format($event->biaya_makanan) }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="15%">Total</td>
                                                    <td width="5%">:</td>
                                                    <th width="80%">Rp. {{ number_format($event->total_budget) }}</th>
                                                </tr>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo_2" aria-expanded="false"
                                                aria-controls="collapseTwo_2">
                                                Detail Lokasi Acara
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo_2" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <table style="width:100%">
                                                <tr>
                                                    <td width="15%">Nama Tempat</td>
                                                    <td width="5%">:</td>
                                                    <th width="80%">{{ $lokasi->nama }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="10%">Harga Sewa / Hari</td>
                                                    <th>:</th>
                                                    <th>Rp. {{ number_format($lokasi->harga) }}</th>
                                                </tr>

                                                <tr>
                                                    <td width="10%">Alamat</td>
                                                    <th>:</th>
                                                    <th>{{ $lokasi->alamat }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="10%">Kapasitas Unit Display</td>
                                                    <th>:</th>
                                                    <th>{{ $lokasi->unit_display }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="10%">Kapasitas Tamu Undangan</td>
                                                    <th>:</th>
                                                    <th>{{ $lokasi->kapasitas_tamu }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="10%">Kapasitas Area Parkir</td>
                                                    <th>:</th>
                                                    <th>{{ $lokasi->kapasitas_parkir }}</th>
                                                </tr>
                                                <tr>
                                                    <td width="10%">Deskripsi</td>
                                                    <th>:</th>
                                                    <th>{{ $lokasi->deskripsi }}</th>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">Gambar</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="row">

                                                            @foreach ($gambar_lokasi as $item)
                                                                <div class="col-md-3">
                                                                    <img src="{{ asset('assets/lokasi_img/' . $item->image_name) }}"
                                                                        onclick="lihatGambar(this)" style="cursor: pointer"
                                                                        class="img-thumbnail" width="350px" alt="">
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse"
                                                data-target="#collapseThree_3" aria-expanded="false"
                                                aria-controls="collapseThree_3">
                                                Dokumentasi & Gambar Layout
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree_3" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">


                                                @foreach ($e_gambar as $item)
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('assets/event_img/' . $item->image_name) }}"
                                                            onclick="lihatGambar(this)" style="cursor: pointer"
                                                            class="img-thumbnail" width="350px" alt="">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="{{ url()->previous() }}" class="float-right btn btn-sm btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="modal fade" id="detil" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" id="gambar_modal" width="100%" />
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script>
        function lihatGambar(thiss) {
            let imgSrc = $(thiss).attr('src');
            $('#gambar_modal').attr('src', imgSrc);
            $('#detil').modal('show')
        }
    </script>
@endsection
