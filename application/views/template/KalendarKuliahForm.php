<div class="ibox-title">
    <h5>Form Kalendar Kuliah  | <code>Tambah data baru</code></h5> 
</div>
<div class="ibox-content">
    <form class="form-horizontal" id="KalendarKuliahForm">
        <div class="form-group"><label class="col-sm-2 control-label">Tahun Akademik</label>
            <div class="col-sm-4"><input type="text" class="form-control" required=""> <span class="help-block m-b-none"><code>silakan isi tahun akademik berjalan. Contoh: 2016/2017.</code></span>
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Semester</label>
            <div class="col-md-2 pull-left">
                <select class="form-control m-b" name="semester" required>
                    <option value=''>[pilih semester] </option>
                    <option value='2'>Genap </option>
                    <option value='1'>Ganjil </option>
                </select>                                            
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Tanggal Mulai</label>
            <div class="col-sm-4"><input type="text" class="form-control" required> <span class="help-block m-b-none"><code>format: yyyy-mm-dd. contoh : 2017-05-22.</code></span>
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Tanggal Selesai</label>
            <div class="col-sm-4"><input type="text" class="form-control" required> <span class="help-block m-b-none"><code>format: yyyy-mm-dd. contoh : 2017-05-22.</code></span>
            </div>
        </div>

        
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-danger" type="button" id="btn_batal">Batal</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script>
$(document).ready(function() {

    $( "#btn_batal" ).click(function() {
        window.open("<?php echo base_url();?>index.php/KalendarController/KalendarKuliah","_self"); 
    });

    $( "#KalendarKuliahForm" ).submit(function( event ) {
        var postData = $('#KalendarKuliahForm').serialize();
        event.preventDefault();

        $.ajax(
        {
           url: "<?php echo base_url();?>index.php/KalendarController/Simpan",
           type: "GET",
           data : postData,                   
           success: function (ajaxData)
           {
                if(1){
                    window.open("<?php echo base_url();?>index.php/KalendarController/KalendarKuliah","_self");
                }
                else{

                }
            },
            error: function(status)
            {

            }
        });
        
    });
});
</script>