@extends('layout.layout')
@section('title', 'Daftar Akun')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <span class="fw-bold h1">
                Data Akun
            </span>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="akun/tambah">
                            <btn class="btn btn-success">Tambah Akun</btn>
                        </a>
                    </div>
                    <p>
                        <hr>
                    <table class="table table-hover table-bordered DataTable">
                        <thead>
                            <tr>
                                <th>USERNAME</th>
                                <th>ROLE</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akun as $a)
                                <tr>
                                    <td>{{ $a->username }}</td>
                                    <td>{{ $a->role }}</td>
                                    <td>
                                        <a href="user/edit/{{ $a->id_user }}">
                                            <btn class="btn btn-primary">EDIT</btn>
                                        </a>
                                        <btn class="btn btn-danger btnHapus" idUser="{{ $a->id_user }}">HAPUS</btn>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idUser = $(this).closest('.btnHapus').attr('idUser');
            swal.fire({
                title: "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'

            }).then((result) => {
                if (result.isConfirmed) {
                    //Ajax Delete
                    $.ajax({
                        type: 'DELETE',
                        url: 'akun/hapus',
                        data: {
                            id_user: idUser,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.success) {
                                swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                    //Refresh Halaman
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>

@endsection
