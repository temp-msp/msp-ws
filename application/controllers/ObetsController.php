<?php
/* ObetsController.php */
defined('BASEPATH') OR exit('No direct script access allowed');

class ObetsController extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library('template');
		$this->load->library('session');
		$this->load->library('excel');
		$this->load->model('User');
	}
	public function index()
	{
		if($this->session->userdata('sess_master'))
   		{			
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );
   			$data['page'] = 'home';
			$this->template->view('template/content',$data);
		}		
		else
		{
			redirect("VerifyLogin",'refresh');
		}
	}

	public function UnderConstruction()
	{
		if($this->session->userdata('sess_master'))
   		{
   			$session_data = $this->session->userdata('sess_master');
   			$data = array('datasession' => $session_data );

			$this->template->view('template/UnderConstructionPage',$data);
		}
		else
		{
			redirect('VerifyLogin','refresh');
		}
		
	}
}

?>