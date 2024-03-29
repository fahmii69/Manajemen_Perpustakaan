@extends('layout.main')

@section('title','Data Buku')

@section('content')
@include('sweetalert::alert')

<!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Buku</span>
    </i>
    <div class="card shadow mb-4">
        <x-tombol_store route="{{ route('buku.create') }}" title='Buku' />

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="buku-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Jmlh. Buku</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('layout.script');
<script>
    $(document).ready(function () {
        var table = $('#buku-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('buku.list')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'pengarang',
                    name: 'pengarang'
                },
                {
                    data: 'penerbit',
                    name: 'penerbit'
                },
                {
                    data: 'jumlah_buku',
                    name: 'jumlah_buku'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });
        
        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');

            deleteConfirmation(id, table);
        })
    });

    function deleteConfirmation(id, table) {
        swal.fire({
            title: "Hapus?",
            icon: 'question',
            text: "Kamuuuh Yakin??!!!",
            showCancelButton: !0,
            confirmButtonText: "Iya, Hapus!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                let token = $('meta[name="csrf-token"]').attr('content');
                var _url = `/buku/${id}`;
                // console.log(123);

                $.ajax({
                    type: 'delete',
                    url: _url,
                    data: {
                        _token: token
                    },

                    success: function (resp) {
                        console.log(123);
                        if (resp.success) {

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            table.ajax.reload();

                            Toast.fire({
                                icon: 'success',
                                title: 'Data Buku Berhasil Dihapus'
                            })
                        } else {
                            swal.fire("Error!", resp.message, "error");
                        }
                    },
                });

            } else {
                e.dismiss;
            }
        }, function (dismiss) {
            return false;
        })
    }
</script>
@endsection
