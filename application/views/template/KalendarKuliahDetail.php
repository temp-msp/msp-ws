<div class="ibox-title">
    <h5>Detail Kalendar Kuliah | ID Kalendar:<code>12345</code> | TA:<code>2016/2017</code> | Semester:<code>Genap</code> | Tgl. Mulai:<code>2017-01-31</code> | Tgl. Selesai:<code>2017-05-31</code></h5> 
    
</div>
<div class="ibox-title">
   <h5>Entry Agenda Libur</h5>
</div>
<div class="ibox-content">
    <form class="form-horizontal" id="KalendarKuliahDetailForm">
        <div class="form-group"><label class="col-sm-2 control-label">Tanggal Mulai</label>
            <div class="col-sm-4"><input type="text" class="form-control" required> <span class="help-block m-b-none"><code>format: yyyy-mm-dd. contoh : 2017-05-22.</code></span>
            </div>
        </div>
        <div class="form-group"><label class="col-sm-2 control-label">Durasi (hari)</label>
            <div class="col-sm-4"><input type="text" class="form-control" required> <span class="help-block m-b-none"><code>Isi dengan angka, jumlah hari pelaksanaan agenda kegiatan.</code></span>
            </div>
        </div>
         <div class="form-group"><label class="col-sm-2 control-label">Agenda</label>
            <div class="col-sm-10"><input type="text" class="form-control" required=""> <span class="help-block m-b-none"><code>Silakan tuliskan deskripsi agenda kegiatan pada tanggal tersebut.</code></span>
            </div>
        </div>

        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-danger" type="button" id="btn_reset">Reset</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
        <div class="ibox-content">
            <div class="table-responsive">               
                <table id='datatable' class="table table-striped table-bordered table-hover display dataTables-example" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Durasi</th>                                       
                    <th>Agenda</th>
                    <th>Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="table-body">
                                     
                </tbody>
                </table>
            </div>
        </div>
                        
    </form>
</div>
<script>
$(document).ready(function() {

    var t = $("#datatable").DataTable();

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