@extends('back.master')
@section('judul')
    Data Lokasi / Tambah Lokasi
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
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Lokasi</h6>
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
                    <form method="POST" action="{{ route('lokasi.store') }}" id="userAdd" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Lokasi
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama" />
                        </div>
                        <div class="form-group">
                            <label>Harga Sewa / Hari
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga Sewa" />
                        </div>
                        <div class="form-group">
                            <label>Deskripsi
                                <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" cols="5" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Alamat
                                <span class="text-danger">*</span></label>
                            <textarea name="alamat" cols="5" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Kapasitas Area Parkir
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kapasitas"
                                placeholder="Contoh : 4 unit Mobil + 100 motor..." />
                        </div>
                        <div class="form-group">
                            <label>Kapasitas Area Unit Display
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="unit_display" required
                                placeholder="Unit Display..." />
                        </div>
                        <div class="form-group">
                            <label>Kapasitas Tamu Undangan
                                <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kapasitas_tamu" required
                                placeholder="Kapasitas Tamu Undangan..." />
                        </div>
                        <div class="form-group">
                            <label for="">Gambar</label>
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
                            <button type="button" class="btn btn-primary btn-sm" id="tambah-gambar"
                                onclick="addGambar()">Tambah Gambar</button><br>
                            <label class="recommendation" style="margin-top: 20px;">
                                Keterangan:<br>
                                <ul>
                                    <li>Rekomendasi Ukuran Gambar: 200x350 pixel</li>
                                    <li>Ukuran File Image Maksimal: 5 Mb</li>
                                    <li>Format Gambar : jpg,jpeg,png</li>
                                </ul>
                            </label>
                        </div>
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
            $('#harga').mask('000.000.000', {
                reverse: true
            });
        })
        @if (session('success'))
            swal("Sukses!", "{{ session('success') }}", "success");
        @endif

        img_id = 1;

        function addGambar() {
            $('#gambar').append(`
                        <tr id="img_` + img_id + `">
                        <td class="validate">
                            <label class="btn btn-raised btn-default btn-sm" style="color: white; width: 180px; background:grey; height: 30px;"> <i class="fa fa-picture-o"></i> Pilih Gambar<input type="file" name="img[]" required accept="image/*" style="opacity: 0;" onchange="hasilgmbr(this)"></label>  
                            <span class="label-gmbr" style="margin-left: 2%;"> Belum Ada Gambar</span>  
                            
                        </td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeGambar(` + img_id + `)"><i class="fa fa-trash"></i></button></td>
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
                    kapasitas: "required",
                    deskripsi: {
                        required: true,
                        minlength: 10
                    },
                    alamat: {
                        required: true,
                        minlength: 5
                    },
                    harga: {
                        required: true,
                    },


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
