<?php
/* RotasiGrup.php */

?>
<!--Start Page Content-->
<div id="page-content">
    <div class="wrapper wrapper-content animated fadeInRight">    
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h2>ROTASI GRUP</h2>
                        <div class="ibox-tools">
                            <br>
                            <div class="hr-line-dashed"></div>
                            <form id="formTampil" onsubmit="return false;">
                            <div class="form-group" id="data_4">
                                <div class="row">
                                    <div class="col-md-2 pull-left">
                                        <select class="form-control m-b" name="tahun">
	                                        <option value='2017'>2017 </option>
                                        </select>                                            
                                    </div>
                                    <div class="col-md-2 pull-left">
                                        <select class="form-control m-b" name="semestet">
                                            <option value='2017'>Genap </option>
                                            <option value='2017'>Ganjil </option>
                                        </select>                                            
                                    </div>
                                    <div class="col-md-2 pull-left">
                                        <select class="form-control m-b" name="semestet">
                                            <option value=''>Semua Angkatan </option>
                                            <option value='2017'>2016 </option>
                                            <option value='2017'>2015 </option>
                                        </select>                                            
                                    </div>
                                    <div class="col-md-3 pull-left">
                                        <button type="submit" class="btn btn-w-m btn-primary" id="btn-submit" ><span class="fa fa-search"></span> Tampilkan</button>
                                        <button type="button" class="btn btn-w-m btn-success" id="btn-tambah" ><span class="fa fa-plus"></span> Rotasi Baru</button>
                                    
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="ibox-content">
                        
	                        <div class="table-responsive">
                                
	                            <table id='datatable' class="table table-striped table-bordered table-hover display dataTables-example" width="100%" cellspacing="0">
	                            <thead>
	                            <tr>
	                                <th>No</th>
	                                <th>Tahun Akademik</th>
	                                <th>Semester</th>                                       
	                                <th>Angkatan</th>
	                                <th>&#931; Grup Max</th>
	                                <th>&#931; Mhs Min</th>
                                    <th>&#931; Mhs Max</th>
                                    <th>Status</th>
	                                <th></th>
	                            </tr>
	                            </thead>
	                            <tbody id="table-body">
	                                                 
	                            </tbody>
	                            </table>

	                        </div>
                        
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
<!--End of Page Content-->
        
<script>
$(document).ready(function() {
    var t = $("#datatable").DataTable({
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
        $(nRow).children("td").css("overflow", "hidden");
        $(nRow).children("td").css("white-space", "nowrap");
        $(nRow).children("td").css("text-overflow", "ellipsis");
        }
    });

    function TampilData(data){
        t.clear().draw();
        
        for(var i=0; i<2; i++)
        {
            var action_btn = "<button class='btn btn-primary btn-xs' type='button' value='"+i+"'>detail</button>"+
            "<button class='btn btn-success btn-xs' type='button' value='"+i+"'>ubah</button>"+
            "<button class='btn btn-danger btn-xs' type='button' value='"+i+"'>hapus</button>";
            var status_mark = "<label class='label label-primary'>unlocked</label><label class='label   label-danger'>locked</label>";
            t.row.add( [
                    i+1,
                    "2017",
                    "Genap",
                    "2016",
                    "76",
                    "3",
                    "4",
                     status_mark,
                    action_btn,                          
                ] ).draw();
        }
    }
    TampilData(null);

    $( "#formTampil" ).submit(function( event ) {
     	var postData = $('#formTampil').serialize();
    	event.preventDefault();
    	/*$.ajax(
        {
           url: "<?php echo base_url();?>index.php/KegiatanDosen/getKegiatanDosenGanda",
           type: "GET",
           data : postData,                   
           success: function (ajaxData)
           {
                t.clear().draw();
                var result = JSON.parse(ajaxData);

                for(var i=0; i<result.length; i++)
                {
                     t.row.add( [
                            i+1,
                            result[i]['id_dosen'],
                            result[i]['nama_dosen'],
                            result[i]['program_studi'],
                            result[i]['kegiatan'],
                            result[i]['tanggal_kegiatan'],
                            result[i]['sks'],
                            result[i]['deskripsi'],
                            result[i]['nomor_kontrak'],
                            result[i]['jumlah'], 
                            "action",                           
                        ] ).draw();
                }
                
            },
            error: function(status)
            {
                t.clear().draw();
            }
        });*/
        
    });


});
</script>