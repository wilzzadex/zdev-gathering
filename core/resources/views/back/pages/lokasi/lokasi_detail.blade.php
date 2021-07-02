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
                            <h6 class="m-0 font-weight-bold text-primary">{{ $lokasi->nama }}</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
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

                                            @foreach ($gambar as $item)
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
                            <a href="{{ route('lokasi') }}" class="float-right btn btn-sm btn-secondary">Kembali</a>
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
