@extends('back.master')
@section('judul')
    Master Data / Data User
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
                        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('user.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mb-1 float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="15px">No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ ucfirst($item->role) }}</td>
                                    <td>
                                        <a href="{{ route('user.edit',$item->id) }}" class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-fw fa-edit"></i>
                                        </a>
                                        <button type="button" onclick="deleteUser(this)" id="{{ $item->id }}" class="btn btn-danger btn-circle btn-sm">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('custom-js')
    <script>
        @if(session('success'))
            swal("Sukses!", "{{ session('success') }}", "success");
        @endif
        $('#dataTable').DataTable();

        function deleteUser(thiss){
            let id = $(thiss).attr('id');
            swal({
                title: "Yakin ?",
                text: "Data Akan Terhapus permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url : '{{ route("user.destroy") }}',
                        type : 'get',
                        data : {
                            id : id
                        },
                        beforeSend : function(){
                            myBlock();
                        },
                        success: function(res){
                            $.unblockUI();
                            if(res == 'no'){
                                swal("Gagal!", "Data tidak bisa di hapus", "warning");
                            }else{
                                swal("Sukses!", "Data Berhasil di hapus", "success").then(function(){
                                    window.location.reload();
                                });
                            }
                        }
                    })
                } 
            });
        }
    </script>
@endsection