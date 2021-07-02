@extends('back.master')
@section('judul')
    Sewa Event Gathering / Tambah Planning Gathering
@endsection
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
                            <h6 class="m-0 font-weight-bold text-primary">Formulir Event Gathering</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('event.store') }}" id="userAdd" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Klien
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" required placeholder="Nama Klien..." />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Acara
                                <span class="text-danger">*</span></label>
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" id="date_start" required name="date_start" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="time" class="form-control" name="jam_mulai" value="00:00">
                                </div>
                                <div class="col-md-2 text-center">
                                    s/d
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_end" required name="date_end" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <input type="time" class="form-control" name="jam_akhir" value="00:00">
                                </div>
                            </div>
                            <input type="hidden" id="total_hari" name="total_hari">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Lokasi
                                    <span class="text-danger">*</span></label>
                                <select name="lokasi_id" required class="form-control" id="lokasi_id">
                                    <option value="">**Pilih Lokasi**</option>
                                    @foreach ($lokasi as $item)
                                        <option data-harga="{{ $item->harga }}" value="{{ $item->id }}">
                                            {{ $item->nama }} |
                                            {{ number_format($item->harga) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6" style="display: ">
                                <label>Total biaya sewa
                                    <span class="text-danger">*</span></label>
                                <input type="text" required id="total_biaya_sewa" name="sewa_tempat" class="form-control"
                                    value="0" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Rundown Acara
                                    <span class="text-danger">*</span></label>
                                <textarea name="rundown_acara" class="form-control" cols="30" rows="7"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>File Pendukung
                                    {{-- <span class="text-danger">*</span></label> --}}
                                <input type="file" name="file_pendukung" class="form-control" accept=".pdf">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label> <b> Budget Planning </b>
                                    <span class="text-danger">*</span></label>
                            </div>

                            <div class="col-md-6">
                                <label>MC
                                    <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="mc" placeholder="MC..." />
                            </div>
                            <div class="col-md-6">
                                <label>Harga
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mc_harga" value="0" onkeyup="hitungTotal(this)"
                                    name="mc_harga" required placeholder="Harga Untuk Mc..." />
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Band / Musik
                                    <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="band" placeholder="Band/Musik..." />
                            </div>
                            <div class="col-md-6">
                                <label>Harga
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="band_harga" value="0"
                                    onkeyup="hitungTotal(this)" required name="band_harga"
                                    placeholder="Harga Untuk Band/musik..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>Undian
                                    <span class="text-danger">*</span></label>
                                <textarea name="undian" class="form-control" cols="30" rows="4"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Harga
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="harga_undian" value="0"
                                    onkeyup="hitungTotal(this)" required name="harga_undian"
                                    placeholder="Harga Untuk Undian..." />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Harga Makanan/porsi
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required id="makanan_harga" name="makanan_per"
                                    value="0" placeholder="Band/Musik..." />
                            </div>
                            <div class="col-md-4">
                                <label>Jumlah Porsi
                                    <span class="text-danger">*</span></label>
                                <input type="number" min="0" class="form-control" required value="0"
                                    onkeyup="hitungTotal(this)" name="jml_porsi" placeholder="Jumlah Porsi..."
                                    id="jml_porsi" />
                            </div>
                            <div class="col-md-4">
                                <label>Total Harga
                                    <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="0" required name="total_makanan"
                                    id="total_makanan" readonly placeholder="Harga Untuk Makanan..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total Budget
                                <span class="text-danger">*</span></label>
                            <input type="text" id="total_budget" readonly class="form-control" required value="0"
                                name="total_budget" readonly placeholder="Harga Untuk Makanan..." />
                        </div>

                        <div class="form-group">
                            <label for="">Contoh Dokumentasi dan Layout</label>
                            <table class="table">

                                <tbody id="gambar">
                                    <tr id="img_0">
                                        <td class="validate">
                                            <label class="btn btn-raised btn-default btn-sm"
                                                style="color: white; width: 180px; background:grey; height: 30px;"> <i
                                                    class="fa fa-picture-o"></i> Pilih Gambar<input required type="file"
                                                    name="img[]" accept="image/*" style="opacity: 0;"
                                                    onchange="hasilgmbr(this)"></label>
                                            <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>

                                        </td>
                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeGambar(0)"><i
                                                    class="fa fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-secondary btn-sm" id="tambah-gambar"
                                onclick="addGambar()">Tambah Dokumentasi</button><br>

                        </div>
                        <br>
                        {{-- <div class="form-group">
                            <label for="">Gambar Layout</label>
                            <table class="table">

                                <tbody id="gambar">
                                    <tr id="img_0">
                                        <td class="validate">
                                            <label class="btn btn-raised btn-default btn-sm"
                                                style="color: white; width: 180px; background:grey; height: 30px;"> <i
                                                    class="fa fa-picture-o"></i> Pilih Gambar<input required type="file"
                                                    name="layout[]" accept="image/*" style="opacity: 0;"
                                                    onchange="hasilgmbr(this)"></label>
                                            <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>

                                        </td>
                                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeGambar(0)"><i
                                                    class="fa fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-secondary btn-sm" id="tambah-gambar"
                                onclick="addGambar()">Tambah Gambar</button><br>
                            <label class="recommendation" style="margin-top: 20px;">
                                Keterangan:<br>
                                <ul>
                                    <li>Rekomendasi Ukuran Gambar: 200x350 pixel</li>
                                    <li>Ukuran File Image Maksimal: 5 Mb</li>
                                    <li>Format Gambar : jpg,jpeg,png</li>
                                </ul>
                            </label>
                        </div> --}}

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>

                    </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lokasi_id').select2();
            $('#mc_harga').mask('000.000.000', {
                reverse: true
            });
            $('#band_harga').mask('000.000.000', {
                reverse: true
            });
            $('#makanan_harga').mask('000.000.000', {
                reverse: true
            });
            $('#harga_undian').mask('000.000.000', {
                reverse: true
            });
        })

        @if (session('success'))
            swal("Sukses!", "{{ session('success') }}", "success");
        @endif

        $('#date_end').on('change', function() {
            let date_start = $('#date_start').val();
            let date_end = $(this).val();
            $.ajax({
                url: '{{ route('event.date') }}',
                type: 'get',
                data: {
                    date_start: date_start,
                    date_end: date_end
                },
                beforeSend: function() {
                    myBlock();
                },
                success: function(res) {
                    $.unblockUI()
                    if (res == 'no-valid') {
                        swal(" ", "Tanggal Acara tidak Valid !", "warning");
                        $("input[type=date]").val("")
                    } else {
                        $('#total_hari').val(res)
                    }
                },
            })
        })

        $('#lokasi_id').on('change', function() {
            let harga = $(this).find(':selected').attr('data-harga');
            let hari = $('#total_hari').val();
            let total_sewa = Number(harga) * Number(hari);

            $('#total_biaya_sewa').mask('000.000.000', {
                reverse: true
            }).val(total_sewa).trigger('input');

            hitungTotal();
        })

        function hitungTotal(thiss) {
            // console.log($(thiss).val())
            let sewa_tempat = $('#total_biaya_sewa').val(),
                sewa_tempat_fix = sewa_tempat.replace(/\./g, "");
            let mc_harga = $('#mc_harga').val(),
                mc_harga_fix = mc_harga.replace(/\./g, "");
            let band_harga = $('#band_harga').val(),
                band_harga_fix = band_harga.replace(/\./g, "");
            let harga_undian = $('#harga_undian').val(),
                harga_undian_fix = harga_undian.replace(/\./g, "");
            let makanan_harga = $('#makanan_harga').val(),
                makanan_harga_fix = makanan_harga.replace(/\./g, "");
            let jml_porsi = $('#jml_porsi').val(),
                jml_porsi_fix = jml_porsi.replace(/\./g, "");

            let total_1 = Number(sewa_tempat_fix) + Number(mc_harga_fix) + Number(band_harga_fix) + Number(harga_undian_fix);

            let total_2 = Number(makanan_harga_fix) * Number(jml_porsi_fix);

            $('#total_makanan').mask('000.000.000', {
                reverse: true
            }).val(total_2).trigger('input');

            let totals = Number(total_1) + Number(total_2);

            // let total_makanan = $('#total_makanan').val(total_2);
            // total_makanan_fix = total_makanan.replace(/\./g, "");

            $('#total_budget').mask('000.000.000', {
                reverse: true
            }).val(totals).trigger('input');


            // console.log(band_harga_fix);
        }

        img_id = 1;

        function addGambar() {
            $('#gambar').append(`
                                <tr id="img_` + img_id + `">
                                <td class="validate">
                                    <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="img[]" required accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                                    <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>  
                                    
                                </td>
                                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeGambar(` +
                img_id + `)"><i class="fa fa-trash"></i></button></td>
                            </tr>
                            `)
            img_id++;
        }

        function removeGambar(id) {
            var items = $('.btn-danger')
            // console.log(items.length) 
            if (items.length == 1) {
                swal({
                    text: "Minimal Terdapat 1 Foto !",
                    icon: "warning",
                });
                // alert('Minimal harus ada 1 gambar !')
            } else {
                $('#img_' + id).remove()
            }
        }

        function hasilgmbr(obj) {
            var url = $(obj).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            var text = url.substring(12);

            if (obj.files && obj.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg")) {
                if (obj.files[0].size > 5242880) {
                    var mb = (5242880 / 1024 / 1024);
                    swal({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File gambar harus lebih kecil dari ' + mb + ' MB',
                    });
                    $('.label-gmbr').html('Tidak ada gambar');
                    $("#inputFile").val('');
                } else {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function() {
                            var height = this.height;
                            var width = this.width;
                            console.log(width + 'x' + height);
                        };
                        $(obj).closest('td').find('.label-gmbr').html(
                            '<a href="javascript:void(0);" onclick="lihat_gmbr(this)" data-toggle="modal" data-target="#detil" data-gmbr="' +
                            e.target.result + '">' + text + '</a>');
                    }
                    reader.readAsDataURL(obj.files[0]);
                }

            } else {
                swal({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Anda salah memasukan gambar. Gambar harus dalam format png/jpeg/jpg!',

                });
                $(obj).val('');
                $('.label-gmbr').text('Belum ada gambar.');
            }
        }

        function lihat_gmbr(obj) {
            var img = $(obj).attr('data-gmbr');
            $('#gambar_modal').attr('src', img);
        }

        var runValidator = function() {
            var form = $('#userAdd');
            var errorHandler = $('.errorHandler', form);
            var successHandler = $('.successHandler', form);
            form.validate({
                errorElement: "span", // contain the error msg in a span tag
                errorClass: 'invalid-feedback',
                errorPlacement: function(error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                ignore: "",
                rules: {
                    nama: "required",
                    username: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    kpassword: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    agree: "required"
                },
                messages: {
                    username: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 3 characters"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    kpassword: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long",
                        equalTo: "Please enter the same password as above"
                    },
                },
                errorElement: "em",
                invalidHandler: function(event, validator) { //display error alert on form submit
                    successHandler.hide();
                    errorHandler.show();
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                success: function(label, element) {
                    label.addClass('help-block valid');
                    // mark the current input as valid and display OK icon
                    $(element).closest('.validate ').removeClass('has-error').addClass('has-success').find(
                        '.symbol').removeClass('required').addClass('ok');
                },
                submitHandler: function(form) {
                    // $('#alert').hide();
                    successHandler.show();
                    errorHandler.hide();
                    // submit form
                    if (successHandler.show()) {
                        myBlock();
                        form.submit();
                    }
                }
            });
        };
        runValidator();
    </script>
@endsection
