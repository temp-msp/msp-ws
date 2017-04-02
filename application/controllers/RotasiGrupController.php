<?php
/* ObetsController.php */
defined('BASEPATH') OR exit('No direct script access allowed');

class RotasiGrupController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->library('session');
		$this->load->model('User');
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

	
	public function RotasiGrup()
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$data['page'] = 'pengelolaan';

			$this->template->view('template/RotasiGrup',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}
}

?>