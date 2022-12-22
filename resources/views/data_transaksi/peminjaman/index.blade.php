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
        var peminjamanId = "";
        var type         = "";

        var table = $('#peminjaman-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('peminjaman.list')}}",
            columns: [{
                    data      : 'DT_RowIndex',
                    name      : 'DT_RowIndex',
                    orderable : false,
                    searchable: false,
                },
                {
                    data: 'detail_pinjaman',
                    name: 'getDetail.buku_id'
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
                    data: 'aksi',
                    name: 'aksi'
                },
            ]
        });

        // 02_PROSES PERPANJANG 
        $(document).on('click', '.tombol-edit', function (e) {
            let id           = $(this).data('id');
                type         = "PERPANJANG";
                peminjamanId = id;

            $.ajax({
                url    : `peminjaman/${id}/edit`,
                type   : 'GET',
                success: function (response) {
                    $('#exampleModal').modal('show');
                    $('#id').val(response.peminjaman.id);
                    $('#editJudulBuku').html(response.blade);
                    $('#nama_siswa').val(response.peminjaman.nama_siswa);
                    $('#tgl_pinjam').val(response.peminjaman.tgl_pinjam);
                    $('#tgl_kembali').val(response.peminjaman.tgl_kembali);
                    $('#tgl_kembali').attr('readonly', false);
                    $('#inputDenda').addClass('disappear');
                },
            });
        });

        // 03_PROSES PENGEMBALIAN
        $(document).on('click', '.btn-return', function () {
            let id = $(this).data('id');

            peminjamanId = id;
            type         = "PENGEMBALIAN";
            
            $.ajax({
                url    : `pengembalian/${id}/edit`,
                type   : 'GET',
                success: function (response) {
                    $('#exampleModal').modal('show');
                    $('#id').val(response.pengembalian.id);
                    $('#editJudulBuku').html(response.html);
                    $('.status').select2();
                    $('#nama_siswa').val(response.pengembalian.nama_siswa);
                    $('#tgl_pinjam').val(response.pengembalian.tgl_pinjam);
                    $('#tgl_kembali').val(response.pengembalian.tgl_kembali);
                    $('#tgl_kembali').attr('readonly', true);
                    $('#inputDenda').removeClass('disappear');
                },
            });
        })

        var savePeminjaman = function(id,type){
            if (type = "PEMINJAMAN"){
                var_url  = `peminjaman/${id}`;
                var_type = 'PATCH';
                var_data = {
                            buku_id    : $('#buku_id').val(),
                            nama_siswa : $('#nama_siswa').val(),
                            tgl_pinjam : $('#tgl_pinjam').val(),
                            tgl_kembali: $('#tgl_kembali').val(),
                        };
            }else{
                var var_url  = `pengembalian/${id}`;
                var var_type = 'PATCH';
                    var_data = {
                            detail     : dataDetail,
                            nama_siswa : $('#nama_siswa').val(),
                            tgl_pinjam : $('#tgl_pinjam').val(),
                            tgl_kembali: $('#tgl_kembali').val(),
                            hilang     : $('#hilang').val(),
                        };
                let dataDetail =[];
                $('.containerBuku').each(function(){
                    buku_id   = $(this).find('.buku_id').val();
                    detail_id = $(this).find('.detail_id').val();
                    status    = $(this).find('.status').val();

                    dataDetail.push({
                        detail_id: detail_id,
                        buku_id  : buku_id,
                        status   : status,
                    });
                });
            }
            
            $.ajax({
                url : var_url,
                type: var_type,
                data: var_data,

                success: function (response) {
                    if (response.success) {
                        const Toast = Swal.mixin({
                                toast            : true,
                                position         : 'top-end',
                                showConfirmButton: false,
                                timer            : 3000,
                                timerProgressBar : true,
                                didOpen          : (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            $('#exampleModal').modal('hide');
                        
                        table.ajax.reload();
                        Toast.fire({
                                icon : 'success',
                                title: 'Pengembalian Buku berhasil'
                            });
                    } else {
                        swal.fire("Error!",
                            response.message,
                            "error");
                    }
                },
            });
        };

        $('#exampleModal').on('hidden.bs.modal', function() {
            $('#id').val('');
            $('#buku_id').val('');
            $('#nama_siswa').val('');
            $('#tgl_pinjam').val('');
            $('#tgl_kembali').val('');
            $('#inputDenda').val('');
            $('#hilang').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });

        $(document).on('click', '.tombol-simpan', function(){
            if(peminjamanId == ""){
                Swal.fire("Error!", "Something wrong!", "error");

                return false;
            }
            
            savePeminjaman(peminjamanId, type);
        });
    });
</script>
@endsection
