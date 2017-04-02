<?php
/* ObetsController.php */
defined('BASEPATH') OR exit('No direct script access allowed');

class KalendarController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->library('session');
		$this->load->model('User');
		$this->load->model('KalendarModel');
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

	
	public function KalendarKuliah()
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$data['page'] = 'pengelolaan';

			$this->template->view('template/KalendarKuliah',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}
	public function KalendarKuliahForm($id)
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$KalendarKuliah = $this->KalendarModel->getKalendarKuliahById($id);
   			$data['KalendarKuliah'] = $KalendarKuliah;
   			$data['page'] = 'pengelolaan';

			$this->template->view('template/KalendarKuliahForm',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}
	public function Simpan()
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			/*$KalendarKuliah = $this->KalendarModel->getKalendarKuliahById($id);
   			$data['KalendarKuliah'] = $KalendarKuliah;
   			$data['page'] = 'pengelolaan';*/
   			if(1){
   				$this->template->view('template/KalendarKuliah',$data);
   			}
   			else{
   				$this->template->view('template/KalendarKuliah',$data);
   			}
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}
	public function KalendarKuliahDetail($id)
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$KalendarKuliah = $this->KalendarModel->getKalendarKuliahById($id);
   			$data['KalendarKuliah'] = $KalendarKuliah;
   			$data['page'] = 'pengelolaan';

			$this->template->view('template/KalendarKuliahDetail',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}
}

?>