<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form</h1>
            </div>
            <div class="modal-body">
                <!-- START FORM -->
                <div class="alert alert-danger d-none"></div>
                <div class="alert alert-success d-none"></div>

                <div class="form-group row">
                    <label for="id" class="col-sm-4 col-form-label">No. Pinjam</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="id" name="id" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="buku_id" class="col-sm-4 col-form-label">Judul</label>
                    <div class="col-sm-8" id='editJudulBuku' >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_siswa" class="col-sm-4 col-form-label">Nama Siswa</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_pinjam" class="col-sm-4 col-form-label">Tanggal Pinjam</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tgl_kembali" class="col-sm-4 col-form-label">Tgl Kembali</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" readonly="readonly" id="tgl_kembali" name="tgl_kembali">
                    </div>
                </div>
                
                <div id='inputDenda' class ='disappear'>
                <x-tombol_denda />
                </div>
                <!-- AKHIR FORM -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn_cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary tombol-simpan" id="tombol-simpan" data-test="0">Simpan</button>
            </div>
        </div>
    </div>
</div>