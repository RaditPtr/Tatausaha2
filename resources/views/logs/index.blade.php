@extends('layout.layout')
@section('title', 'Daftar Guru')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="h1">
                            Data Log Activity
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="surat/hapus" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-warning" type="button" id="checkAll">Select Semua</button>
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                    <table class="table table-hover table-bordered DataTable mt-2">
                                        <thead>
                                            <tr>
                                                <th>Aktivitas</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logsy as $tx)
                                                <tr>
                                                    <td>{{ $tx->logs }}</td>
                                                    <td>
                                                        <input type="checkbox" class="checkbox" name="id_logs[]"
                                                            value="{{ $tx->id_logs }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </form>
                    </div>
                    <div class="card-footer">
    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="module">
        $('.DataTable tbody').on('click', '.btnHapus', function(a) {
            a.preventDefault();
            let idGuru = $(this).closest('.btnHapus').attr('idGuru');
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
                        url: 'dashboard/hapus',
                        data: {
                            id_guru: idGuru,
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
