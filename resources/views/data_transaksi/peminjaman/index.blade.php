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
                {data: 'bukus', name: 'getJudul.judul'},
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
                    'render': function (data,type,row){
                    return (data == true) ? 'Ntaps' : 'belum'
                    }
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });

    // 03_PROSES EDIT 
    $('body').on('click', '.tombol-edit', function(e) {
        var id = $(this).data('id');
        // var url =  'peminjaman/' + id + '/edit';
        // console.log(url);

        $.ajax({
            url: 'peminjaman/' + id + '/edit',
            type: 'GET',
            cache: false,
            // error: console.error,
            success: function(response) {
                $('#exampleModal').modal('show');
                console.log(response.id);
                $('#id').val(response.id);
                $('#buku_id').val(response.buku_id);
                $('#nama_siswa').val(response.nama_siswa);
                $('#tgl_pinjam').val(response.tgl_pinjam);
                $('#tgl_kembali').val(response.tgl_kembali);

                $('.tombol-simpan').click(function() {
                });
            },
            error: function (response) {
                        swal.fire("Error!", 'Something went wrong.', "error");
                    }
        });
    });

    $('#exampleModal').on('hidden.bs.modal', function() {
        $('#id').val('');
                $('#buku_id').val('');
                $('#nama_siswa').val('');
                $('#tgl_pinjam').val('');
                $('#tgl_kembali').val('');

        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
    });
        
        
        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');

            deleteConfirmation(id, table);
        })
    });

    function deleteConfirmation(id, table) {
        swal.fire({
            title: "Perpanjang Durasi Peminjaman buku?",
            icon: 'question',
            text: "Kamuuuh Yakin??!!!",
            showCancelButton: !0,
            confirmButtonText: "Iya, Hapus!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                let token = $('meta[name="csrf-token"]').attr('content');
                var _url = `/peminjaman/${id}`;

                $.ajax({
                    type: 'delete',
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