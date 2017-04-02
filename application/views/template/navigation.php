<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url('assets');?>/img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $datasession['name']; ?></strong>
                             </span> <span class="text-muted text-xs block">Administrator<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="<?php echo site_url('MainControler/Profile');?>">Profile</a></li>
                                
                                <li class="divider"></li>
                                <li><a href="<?php echo site_url('MainControler/logout');?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            FK-US
                        </div>
                    </li>
                    <li id="home">
                        <a href="<?php echo site_url('MainControler');?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>                        
                    </li>
                    <li id="data_master">
                        <a href="#"><i class="fa fa-briefcase"></i> <span class="nav-label">Data Master</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo site_url('ObetsController/UnderConstruction');?>"><i class="fa fa-list-ul"></i>Mahasiswa</a></li>
                            <li><a href="<?php echo site_url('ObetsController/UnderConstruction');?>"><i class="fa fa-list-ul"></i>Matakuliah</a></li>
                            <li><a href="<?php echo site_url('ObetsController/UnderConstruction');?>"><i class="fa fa-list-ul"></i>Lokasi Kuliah</a></li>
                        </ul>
                    </li>
                    <li id="pengelolaan">
                        <a href="#"><i class="fa fa-random"></i> <span class="nav-label">Pengelolaan</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo site_url('KalendarController/KalendarKuliah');?>"><i class="fa fa-calendar-o"></i>Kalendar Kuliah</a></li>
                            <li><a href="<?php echo site_url('RotasiGrupController/RotasiGrup');?>"><i class="fa fa-users"></i>Rotasi Grup</a></li>
                            <li><a href="<?php echo site_url('JadwalKuliahController/JadwalKuliah');?>"><i class="fa fa-calendar"></i>Jadwal Kuliah</a></li>
                        </ul>
                    </li>
                    
                </ul>

            </div>
        </nav>
<script type="text/javascript">
    var page = "<?php echo $page; ?>";
    var pagestring = "#"+page;
    $(pagestring).addClass('active');
</script>