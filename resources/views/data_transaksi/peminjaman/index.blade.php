@extends('layout.main')

@section('title','Data Peminjaman')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Peminjaman</span>
    </i>
    <div class="card shadow mb-4">
        @include('sweetalert::alert')
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="peminjaman-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. Pinjam</th>
                            <th>Judul</th>
                            <th>Nama Siswa</th>
                            <th>Tgl. Pinjam</th>
                            <th>Tgl. Kembali</th>
                            <th>Status</th>
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
@include('data_transaksi.peminjaman.modal')
@endsection

@section('script')
@include('layout.script');
<script>
    $(document).ready(function () {
        var table = $('#peminjaman-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('peminjaman.list')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'bukus',
                    name: 'getJudul.judul'
                },
                {
                    data: 'nama_siswa',
                    name: 'nama_siswa'
                },
                {
                    data: 'tgl_pinjam',
                    name: 'tgl_pinjam'
                },
                {
                    data: 'tgl_kembali',
                    name: 'tgl_kembali'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });

        // 03_PROSES EDIT 
        $('body').on('click', '.tombol-edit', function (e) {
            let id = $(this).data('id');
            $.ajax({
                url: 'peminjaman/' + id + '/edit',
                type: 'GET',
                success: function (response) {
                    $('#exampleModal').modal('show');
                    $('#id').val(response.id);
                    $('#buku_id').val(response.buku_id);
                    $('#nama_siswa').val(response.nama_siswa);
                    $('#tgl_pinjam').val(response.tgl_pinjam);
                    $('#tgl_kembali').val(response.tgl_kembali);
                    $('.tombol-simpan').click(function () {

                        var var_url = 'peminjaman/' + id;
                        var var_type = 'PATCH';
                        $.ajax({
                            url: var_url,
                            type: var_type,
                            data: {
                                buku_id: $('#buku_id').val(),
                                nama_siswa: $('#nama_siswa').val(),
                                tgl_pinjam: $('#tgl_pinjam').val(),
                                tgl_kembali: $('#tgl_kembali').val(),
                            },
                            success: function (response) {
                                if (response.success) {
                                    swal.fire("Done!", response.message,
                                        "success");
                                    $('#exampleModal').modal('hide');
                                    table.ajax.reload();
                                } else {
                                    swal.fire("Error!",
                                        'Something went wrong.',
                                        "error");
                                }
                            },
                            error: function (response) {
                                $('.alert-danger').removeClass(
                                'd-none');
                                $('.alert-danger').html("<ul>");
                                $.each(response.responseJSON.errors,
                                    function (key, value) {
                                        $('.alert-danger').find(
                                            'ul').append(
                                            "<li>" + value +
                                            "</li>");
                                    });
                                $('.alert-danger').append("</ul>");
                            },
                        });
                    });
                },
                error: function (response) {
                    swal.fire("Error!", 'Something went wrong.', "error");
                }
            });
        });

        $(document).on('click', '.btn-return', function () {
            let id = $(this).data('id');
            returnConfirmation(id, table);
        })
    });

    function returnConfirmation(id, table) {
        swal.fire({
            title: "Sudah di cek kondisi buku ?",
            icon: 'question',
            text: "Kamuuuh Yakin??!!!",
            showCancelButton: !0,
            confirmButtonText: "Iya!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                let token = $('meta[name="csrf-token"]').attr('content');
                var _url = `/peminjaman/${id}/return`;

                $.ajax({
                    type: 'patch',
                    url: _url,
                    data: {
                        _token: token
                    },
                    success: function (resp) {
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
                                title: 'Signed in successfully'
                            })
                        }else{
                            swal.fire("Error!", resp.message, "error");
                        }
                    },
                    error: function (resp) {
                        swal.fire("Error!", 'Something went wrong.', "error");
                    }
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
