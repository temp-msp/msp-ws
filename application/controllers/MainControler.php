<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainControler extends CI_Controller {


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
	
	public function logout()
 	{
   		$this->session->unset_userdata('sess_master');
   		session_destroy();
   		redirect('VerifyLogin', 'refresh');
 	}
	public function login()
	{
		$this->template->loginpage();
	}
	public function ubahPassword()
	{
		$data['pass'] = $_POST['passbaru'];
		$session_data = $this->session->userdata('sess_master');

		$data['user'] = $session_data['name'];

		$res = $this->User->ubahPassword($data);

		echo json_decode($res);
	}
	
}