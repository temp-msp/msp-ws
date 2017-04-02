<?php
/* JadwalKuliahController.php */
defined('BASEPATH') OR exit('No direct script access allowed');

class JadwalKuliahController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->library('session');
		$this->load->model('User');
		$this->load->model('JadwalKuliahModel');
	}
	public function index()
	{
		if($this->session->userdata('sess_master'))
   		{			
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$data['page'] = 'pengelolaan';
			$this->template->view('template/content',$data);
		}		
		else
		{
			redirect("VerifyLogin",'refresh');
		}
	}

	
	public function JadwalKuliah()
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');

   			$this->load->model('jadwal_m');

   			$data['datasession'] = $session_data;
   			$data['page'] = 'pengelolaan';
   			$data['jadwal'] = $this->jadwal_m->get();

			$this->template->view('template/JadwalKuliah',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}

	public function UbahJadwal($idJadwal)
	{
		if (!isset($idJadwal))
		{
			redirect('JadwalKuliahController/JadwalKuliah');
			exit;
		}

		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');

   			$this->load->model('jadwal_m');
   			$this->load->model('jadwal_kuliah_m');
   			$this->load->model('grup_m');
   			$this->load->model('matakuliah_m');
   			$this->load->model('anggota_grup_m');

   			$data['id_jdwl'] = $idJadwal;
   			$data['datasession'] = $session_data;
   			$data['page'] = 'pengelolaan';
   			$data['jadwal_k'] = $this->jadwal_m->get_row(['id_jadwal' => $idJadwal]);
   			$data['matakuliah'] = $this->matakuliah_m->get(['status_aktif' => 1]);
   			$data['jadwal_kuliah'] = $this->jadwal_kuliah_m->get(['id_jadwal' => $idJadwal]);
   			$data['list_grup'] = $this->db->query('SELECT id_grup FROM jadwal_kuliah GROUP BY id_grup')->result();

   			if ($this->input->post('reload_table'))
   			{
   				if ($this->input->post('is_swap'))
   				{
   					$swap_data = $this->input->post('swap');
   					print_r($swap_data);
   					$swap1 = $this->jadwal_kuliah_m->get_row(['id_jadwal_kuliah' => $swap_data[0]['id_jadwal']]);
   					$swap2 = $this->jadwal_kuliah_m->get_row(['id_jadwal_kuliah' => $swap_data[1]['id_jadwal']]);
   					$this->jadwal_kuliah_m->update($swap1->id_jadwal_kuliah, [
   							'id_matakuliah' => $swap2->id_matakuliah
   						]);
   					$this->jadwal_kuliah_m->update($swap2->id_jadwal_kuliah, [
   							'id_matakuliah' => $swap1->id_matakuliah
   						]);
   					exit;
   				}

   				$jadwal = [];
                $i = 0;
                foreach ($data['list_grup'] as $grup)
                {
                    $jadwal []= ['id_grup' => $grup->id_grup, 'jadwal' => []];
                    foreach ($data['jadwal_kuliah'] as $row)
                    {
                        if ($row->id_grup == $grup->id_grup)
                        {
                            $jadwal[$i]['jadwal'] []= ['id_jadwal_kuliah' => $row->id_jadwal_kuliah, 'nama' => $this->matakuliah_m->get_row(['id_matakuliah' => $row->id_matakuliah])->nama];
                        }
                    }
                    $i++;
                }
                
                $record_mk = [];
                foreach ($data['matakuliah'] as $row)
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
   				exit;
   			}

			$this->template->view('template/UbahJadwal',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
	}

	public function JadwalKuliahDetail($idJadwalKuliah)
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$data['page'] = 'pengelolaan';

   			$jadwalKuliah = $this->JadwalKuliahModel->getJadwalKuliahById($idJadwalKuliah);
   			$data['jadwalKuliah']=$jadwalKuliah;

			$this->template->view('template/JadwalKuliahDetail',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}

// echo datediff('ww', '9 July 2003', '4 March 2004', false);
// menghitung jumlah minggu antara dua tanggal

	public function JadwalKuliahBaru()
	{
		if($this->session->userdata('sess_master'))
   		{
   			$this->session->unset_userdata('temp_jadwal');
   			$this->load->model('kalendar_m');
   			$this->load->model('jadwal_kuliah_m');
   			$this->load->model('grup_m');
   			$this->load->model('matakuliah_m');
   			$this->load->model('anggota_grup_m');

   			// tahun ajaran yang aktif
   			$data['tahun_ajaran'] 	= $this->kalendar_m->get_row(['status' => 1]);
   			$data['jumlah_minggu']	= $this->datediff('ww', $data['tahun_ajaran']->tanggal_mulai, $data['tahun_ajaran']->tanggal_selesai, FALSE);
   			$data['list_grup']		= $this->grup_m->get(['id_kalendar' => $data['tahun_ajaran']->id_kalendar]);
   			$data['mata_kuliah']	= $this->matakuliah_m->get(['status_aktif' => 1]);
   			if ($this->input->post('generate'))
   			{
   				$mata_kuliah = [];
   				$grup = [];
   				$record_mk = [];
   				foreach ($data['mata_kuliah'] as $mk)
   				{
   					$mata_kuliah []= $mk->nama;
   					$record_mk [$mk->nama]= $mk->durasi;
   				}

   				foreach ($data['list_grup'] as $list_grup)
   					$grup []= ['id_grup' => $list_grup->id_grup, 'nomor_urut' => $list_grup->nomor_urut, 'jadwal' => []];
   				shuffle($mata_kuliah);
   				$jadwal = $this->scheduling($mata_kuliah, $grup);
   				$this->session->set_userdata('temp_jadwal', $jadwal);

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
					'Anastesi' 	=> 'purple',
					'Dalam'		=> 'green',
					'Jiwa'		=> 'grey',
					'Obgin'		=> 'red',
					'Mata'		=> 'yellow',
					'Rehab'		=> 'darkgreen',
					'Gilut'		=> 'orange',
					'Anak'		=> 'magenta',
					'THT'		=> 'teal',
					'IKM'		=> 'orange',
					'Kulit'		=> 'grey',
					'Bedah'		=> 'lightblue',
					'Forensik'	=> 'darkblue',
					'Radio'		=> 'yellow',
					'Libur'		=> 'white',
					'Saraf'		=> 'orange'
				];

				foreach ($jadwal as $row)
				{
					$html .= "<tr>";
					$k = 0;
					$row['jadwal'] = array_diff($row['jadwal'], ['TEMP']);
					foreach ($row['jadwal'] as $schedule)
					{
						if ($k == 0)
						{
							$anggota_grup = $this->anggota_grup_m->get(['id_grup' => $row['id_grup']]);
							$html .= "<td>GRUP " . ($j + 1) . "</td>
									<td>".count($anggota_grup)."</td>";
						}
						$html .= "<td style='background-color: ".$colors[$schedule]."' colspan='".$record_mk[$schedule]."'>" . $schedule . "</td>";
						$k++;
					}
					$html .= "<tr>";
					$j++;
				}
				$html .= "</tbody></table>";
				echo $html;
   				exit;
   			}


   			$session_data = $this->session->userdata('sess_master');
   			$data['datasession'] = $session_data;
   			$data['page'] = 'pengelolaan';

			$this->template->view('template/JadwalKuliahBaru',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
	}

	public function SimpanJadwal()
	{
		if ($this->input->post('simpan'))
		{
			ini_set('max_execution_time', 60);
			$this->load->model('jadwal_m');
			$this->load->model('jadwal_kuliah_m');
			$this->load->model('kalendar_m');
			$this->load->model('matakuliah_m');

			$jadwal = $this->session->userdata('temp_jadwal');
			if (!isset($jadwal))
			{
				redirect('JadwalKuliahController/JadwalKuliahBaru');
				exit;
			}

			$data_jadwal = [
				'nama'		=> $this->input->post('nama_jadwal'),
				'semester'	=> $this->input->post('semester'),
				'angkatan'	=> $this->input->post('angkatan')
			];
			$this->jadwal_m->insert($data_jadwal);
			$id_jadwal = $this->db->insert_id();

			// tahun ajaran yang aktif
   			$data['tahun_ajaran'] 	= $this->kalendar_m->get_row(['status' => 1]);

			foreach ($jadwal as $row)
			{
				$id_grup = $row['id_grup'];
				foreach ($row['jadwal'] as $r)
				{
					$mk = $this->matakuliah_m->get_row(['nama' => $r]);
					if (isset($mk))
					{
						$data_jadwal_kuliah = [
							'id_jadwal'		=> $id_jadwal,
							'id_kalendar'	=> $data['tahun_ajaran']->id_kalendar,
							'id_grup'		=> $id_grup,
							'id_matakuliah'	=> $mk->id_matakuliah,
							'status'		=> 1
						];
						$this->jadwal_kuliah_m->insert($data_jadwal_kuliah);
					}
				}
			}

			$this->session->unset_userdata('temp_jadwal');
		}

		redirect('JadwalKuliahController/JadwalKuliahBaru');
		exit;
	}

	private function scheduling($mata_kuliah, $grup)
	{
		$temp_index = [];
		if (count($mata_kuliah) % 2 != 0)
			$mata_kuliah []= 'TEMP';

		for ($i = 0; $i < count($grup); $i++)
		{
			$temp_mk = $mata_kuliah;
			while (count($temp_mk) > 0)
			{
				for ($j = 0; $j < count($temp_mk); $j++)
				{
					if (!in_array($temp_mk[$j], $grup[$i]['jadwal']))
					{
						if (!isset($temp_index[$temp_mk[$j]]))
							$temp_index[$temp_mk[$j]] = [];
						$grup[$i]['jadwal'] []= $temp_mk[$j];
						$idx = array_search($temp_mk[$j], $grup[$i]['jadwal']);
						if (array_search($idx, $temp_index[$temp_mk[$j]]) !== FALSE)
						{
							unset($grup[$i]['jadwal'][count($grup[$i]['jadwal']) - 1]);
							$grup[$i]['jadwal'] = array_values($grup[$i]['jadwal']);
						}
						else
						{
							$temp_index[$temp_mk[$j]] []= $idx;
							if (count($temp_index[$temp_mk[$j]]) >= 15)
								$temp_index[$temp_mk[$j]] = [];
							unset($temp_mk[$j]);
							$temp_mk = array_values($temp_mk);
							break;
						} 

					}
				}
			}
		}

		return $grup;
	}

	private function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
	    /*
	    $interval can be:
	    yyyy - Number of full years
	    q - Number of full quarters
	    m - Number of full months
	    y - Difference between day numbers
	        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
	    d - Number of full days
	    w - Number of full weekdays
	    ww - Number of full weeks
	    h - Number of full hours
	    n - Number of full minutes
	    s - Number of full seconds (default)
	    */
	    
	    if (!$using_timestamps) {
	        $datefrom = strtotime($datefrom, 0);
	        $dateto = strtotime($dateto, 0);
	    }
	    $difference = $dateto - $datefrom; // Difference in seconds
	     
	    switch($interval) {
	     
	    case 'yyyy': // Number of full years

	        $years_difference = floor($difference / 31536000);
	        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
	            $years_difference--;
	        }
	        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
	            $years_difference++;
	        }
	        $datediff = $years_difference;
	        break;

	    case "q": // Number of full quarters

	        $quarters_difference = floor($difference / 8035200);
	        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
	            $months_difference++;
	        }
	        $quarters_difference--;
	        $datediff = $quarters_difference;
	        break;

	    case "m": // Number of full months

	        $months_difference = floor($difference / 2678400);
	        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
	            $months_difference++;
	        }
	        $months_difference--;
	        $datediff = $months_difference;
	        break;

	    case 'y': // Difference between day numbers

	        $datediff = date("z", $dateto) - date("z", $datefrom);
	        break;

	    case "d": // Number of full days

	        $datediff = floor($difference / 86400);
	        break;

	    case "w": // Number of full weekdays

	        $days_difference = floor($difference / 86400);
	        $weeks_difference = floor($days_difference / 7); // Complete weeks
	        $first_day = date("w", $datefrom);
	        $days_remainder = floor($days_difference % 7);
	        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
	        if ($odd_days > 7) { // Sunday
	            $days_remainder--;
	        }
	        if ($odd_days > 6) { // Saturday
	            $days_remainder--;
	        }
	        $datediff = ($weeks_difference * 5) + $days_remainder;
	        break;

	    case "ww": // Number of full weeks

	        $datediff = floor($difference / 604800);
	        break;

	    case "h": // Number of full hours

	        $datediff = floor($difference / 3600);
	        break;

	    case "n": // Number of full minutes

	        $datediff = floor($difference / 60);
	        break;

	    default: // Number of full seconds (default)

	        $datediff = $difference;
	        break;
	    }    

	    return $datediff;

	}

}

?>