@extends('layout.main')

@section('title','Data Peminjaman')

@section('content')
@include('sweetalert::alert')

<!-- Begin Page Content -->
<div class="container-fluid">
    <i class="fas fa-clock">
        <span class="h3 mb-4 text-gray-800">Data Peminjaman</span>
    </i>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="col-md-4">
                <label for="" class="row">Date Range</label>
                <input type="text" name="daterange" class="form-control row" value="" id="daterange" />
                <br>
                <button class="row btn btn-success btn-icon-split btn-export">
                    <input type="hidden" name="jenis" class="form-control row" value="Peminjaman" id="jenis" />
                    <span class="icon text-white-50">
                        <i class="fas fa-file"></i>
                    </span>
                    <span class="text" >Export Excel</span>
                </button>
            </div>
            <br>
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
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            locale:{
                format: 'DD/MM/YYYY'
            }
        }, function(startDate, endDate, label) {
            console.log(startDate, endDate)
            console.log("A new date selection was made: " + startDate.format('YYYY-MM-DD') + ' to ' + endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').val(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format('YYYY-MM-DD'));
            $('input[name="daterange"]').html(startDate.format('YYYY-MM-DD') + ' - ' + endDate.format('YYYY-MM-DD'));
        });
    });

    $(document).on('click', '.btn-export', function(){
        let url = "{{ route('laporan.export',['daterange' => 'x1' , 'jenis' => 'x2']) }}";
        url = url.replace("x1", $('#daterange').val());
        url = url.replace("x2", $('#jenis').val());
        url = url.replaceAll("&amp;", "&");
        window.open(url, '_blank');
    });

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
                },
            });
        });

        // 03_PROSES PENGEMBALIAN
        $(document).on('click', '.btn-return', function () {
            let id = $(this).data('id');

            peminjamanId = id;
            type         = "PENGEMBALIAN";
            console.log(type);
            
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
                },
            });
        })

        var savePeminjaman = function(id,type){
            if (type == "PERPANJANG"){
                var var_url  = `peminjaman/${id}`;
                var var_type = 'PATCH';
                var var_data = {
                            buku_id    : $('#buku_id').val(),
                            nama_siswa : $('#nama_siswa').val(),
                            tgl_pinjam : $('#tgl_pinjam').val(),
                            tgl_kembali: $('#tgl_kembali').val(),
                        };
            }
            if( type == "PENGEMBALIAN"){
                var var_url  = `pengembalian/${id}`;
                var var_type = 'PATCH';
                var dataDetail = [];
                var bukuHilangValue = 0;
                
                $('.containerBuku').each(function(){
                    buku_id   = $(this).find('.buku_id').val();
                    detail_id = $(this).find('.detail_id').val();
                    status    = $(this).find('.status').val();
                    hilang    = $(this).find('.bukuHilang').val();
                    
                    dataDetail.push({
                        detail_id: detail_id,
                        buku_id  : buku_id,
                        status   : status,
                        hilang   : Number(hilang),
                    })
                });

                var var_data = {
                    detail     : dataDetail,
                    nama_siswa : $('#nama_siswa').val(),
                    tgl_pinjam : $('#tgl_pinjam').val(),
                    tgl_kembali: $('#tgl_kembali').val(),
                    hilang     : dataDetail.map(data => data.hilang).reduce((prev, curr) => prev + curr, 0),
                };
            };

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
            $('#hilang').val('');

            $('.alert-danger').addClass('d-none');
            $('.alert-danger').html('');

            $('.alert-success').addClass('d-none');
            $('.alert-success').html('');
        });

        $(document).on('change', '.status', function(){
            const bool = Boolean($(this).val() === "DIKEMBALIKAN");
            $(this).closest('.containerBuku').find('.bukuHilang').attr('readonly', bool);
            // $('.bukuHilang').attr('readonly', bool);
            // let buku_id = $(this).select2().find(":selected").data("buku-id");
            // $('.input-buku-' + buku_id).attr('readonly', bool);
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
