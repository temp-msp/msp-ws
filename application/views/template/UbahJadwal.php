<style type="text/css">
    .matakuliah {
        transition-property: border-color, border-width;
        transition-duration: 0.1s, 0.1s;
        transition-timing-function: ease-out, ease-out;
    }

    .matakuliah:hover {
        border-width: 5px;
        border-color: rgba(0, 255, 0, 0.7);
        cursor: pointer;
    }
</style>
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

                    <table class="table" style="width: 40%;">
                        <tr>
                            <td><b>Nama Jadwal</b></td>
                            <td>:</td>
                            <td><?= $jadwal_k->nama ?></td>
                        </tr>
                        <tr>
                            <td><b>Semester</b></td>
                            <td>:</td>
                            <td><?= $jadwal_k->semester % 2 == 0 ? 'Genap' : 'Ganjil' ?></td>
                        </tr>
                        <tr>
                            <td><b>Angkatan</b></td>
                            <td>:</td>
                            <td><?= $jadwal_k->angkatan ?></td>
                        </tr>
                    </table>
                    <span id="msg">Anda dapat menukar jadwal antar matakuliah pada grup yang sama dengan klik dua matakuliah yang ingin ditukar</span>
                    <div id="tbl" style="width: 100%; overflow-x: scroll;">
                        <?php  
                            $jadwal = [];
                            $i = 0;
                            foreach ($list_grup as $grup)
                            {
                                $jadwal []= ['id_grup' => $grup->id_grup, 'jadwal' => []];
                                foreach ($jadwal_kuliah as $row)
                                {
                                    if ($row->id_grup == $grup->id_grup)
                                    {
                                        $jadwal[$i]['jadwal'] []= ['id_jadwal_kuliah' => $row->id_jadwal_kuliah, 'nama' => $this->matakuliah_m->get_row(['id_matakuliah' => $row->id_matakuliah])->nama];
                                    }
                                }
                                $i++;
                            }

                            $record_mk = [];
                            foreach ($matakuliah as $row)
                                $record_mk[$row->nama] = $row->durasi;

                            $html = "<table class='table table-bordered' style='color: black;'>
                                    <thead>
                                        <tr>
                                            <th>Grup</th>
                                            <th>Mhs</th>";
                            for ($i = 1; $i <= 85; $i++)
                                $html .= "<th>".$i."</th>";
                                            
                            $html .= "</tr>
                                    </thead>
                                    <tbody>";
                            $j = 0;

                            $colors = [
                                'Anastesi'  => 'purple',
                                'Dalam'     => 'green',
                                'Jiwa'      => 'grey',
                                'Obgin'     => 'red',
                                'Mata'      => 'yellow',
                                'Rehab'     => 'darkgreen',
                                'Gilut'     => 'orange',
                                'Anak'      => 'magenta',
                                'THT'       => 'teal',
                                'IKM'       => 'orange',
                                'Kulit'     => 'grey',
                                'Bedah'     => 'lightblue',
                                'Forensik'  => 'darkblue',
                                'Radio'     => 'yellow',
                                'Libur'     => 'white',
                                'Saraf'     => 'orange'
                            ];

                            foreach ($jadwal as $row)
                            {
                                $html .= "<tr>";
                                $k = 0;
                                foreach ($row['jadwal'] as $schedule)
                                {
                                    if ($k == 0)
                                    {
                                        $anggota_grup = $this->anggota_grup_m->get(['id_grup' => $row['id_grup']]);
                                        $html .= "<td>GRUP " . ($j + 1) . "</td>
                                                <td>".count($anggota_grup)."</td>";
                                    }
                                    $html .= "<td data-id-grup='".$row['id_grup']."' data-id-jadwal='".$schedule['id_jadwal_kuliah']."' class='matakuliah' style='background-color: ".$colors[$schedule['nama']]."' colspan='".$record_mk[$schedule['nama']]."'>" . $schedule['nama'] . "</td>";
                                    $k++;
                                }
                                $html .= "<tr>";
                                $j++;
                            }
                            $html .= "</tbody></table>";
                            echo $html;
                        ?>
                    </div>
                    

                    <hr>
                    <!-- <p>Status <code>Open</code> | <code>telah disimpan</code></p> -->
            </div>
        </div>
    </div>
</div>
<div id="jscript-reload">
    <script type="text/javascript">
    $(document).ready(function() {
        var swap = [];

        $(".matakuliah").on("click", function() {
            $(this).css("border-width", "10px");
            $(this).css("border-color", "lightgreen");
            swap.push({
                id_grup: $(this).attr("data-id-grup"),
                id_jadwal: $(this).attr("data-id-jadwal")
            });
            if (swap.length >= 2)
            {
                if (swap[0].id_grup != swap[1].id_grup)
                {
                    swap = [];
                    $("#msg").html("<span style='color: red;'>Matakuliah yang ditukar harus berada pada grup yang sama</span>");
                    $.ajax({
                        url: '<?= base_url("index.php/JadwalKuliahController/UbahJadwal/" . $id_jdwl) ?>',
                        type: 'POST',
                        data: {
                            reload_table: true
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(e) {
                            alert(e.responseText);
                        }
                    });
                    return false;
                }
                else
                {
                    $.ajax({
                        url: '<?= base_url("index.php/JadwalKuliahController/UbahJadwal/" . $id_jdwl) ?>',
                        type: 'POST',
                        data: {
                            reload_table: true,
                            is_swap: true,
                            swap: swap
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(e) {
                            alert(e.responseText);
                        }
                    });
                    return true;
                }
            }
        });
    });
</script>
</div>