<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Buat Jadwal Kuliah Baru</h5>
            </div>
            <div class="ibox-content">
                    <!-- <p>Tahun Akademik <code>2017</code> | Semester <code>Genap</code> | Angkatan <code>2016</code></p> -->
                    
                    <div class="col-md-12">
                        
                        <!-- <button type="button" class="btn btn-w-m btn-success" id="btn-simpan" ><span class="fa fa-save"></span> Simpan</button>
                        <button type="button" class="btn btn-w-m btn-primary" id="btn-export" ><span class="fa fa-file-excel-o"></span> Export</button> -->
                    </div>

                    <?= form_open('JadwalKuliahController/SimpanJadwal') ?>
                    <div class="form-group">
                        <label for="nama_jadwal">Nama Jadwal</label>
                        <input required type="text" class="form-control" name="nama_jadwal">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input required type="number" min="1" max="8" class="form-control" name="semester">
                    </div>
                    <div class="form-group">
                        <label for="angkatan">Angkatan</label>
                        <input required type="number" min="2000" max="3000" class="form-control" name="angkatan">
                    </div>
                    <span class="pull-left" id="submit-btn-container"></span>
                    <button type="submit" class="btn btn-w-m btn-danger pull-right" id="btn-generate" onclick="generateJadwal(); return false;"><span class="fa fa-adjust"></span> Generate Jadwal</button>
                    <div style="width: 100%; overflow-x: scroll;" id="table-jadwal">
                        Klik <i>generate jadwal</i> untuk membuat jadwal otomatis
                    </div>
                    
                    <?= form_close() ?>

                    <hr>
                    <!-- <p>Status <code>Open</code> | <code>telah disimpan</code></p> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function generateJadwal() {
        $.ajax({
            url: '<?= base_url('index.php/JadwalKuliahController/JadwalKuliahBaru') ?>',
            type: 'POST',
            data: {
                generate: true
            },
            success: function(response) {
                $('#table-jadwal').html(response);
                $('#submit-btn-container').html('<input type="submit" class="btn btn-success btn-lg" name="simpan" value="Simpan">');
            },
            error: function(e) {
                alert(e.responseText);
            }
        });
    }
</script>