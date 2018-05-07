<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	//include (APPPATH .'asset/esdk_obs_native_php/obs-autoloader.php');


	public function __construct(){
		parent::__construct();
		$this->load->model('m_login');
		
	}
	public function index()
	{
		$this->load->view('login');	
	}

	public function do_login()
	{
		$param['email']=$_POST['username'];
		$param['password']=$_POST['password'];
		$user=$this->m_login->do_login($param);
		if ($user['message']=='error'){
			$this->session->set_flashdata('error', 'value');
			redirect('login');
		}
		elseif ($user['message']=='sukses') {
			$_SESSION['token']=$user['token'];
			$_SESSION['email']=$user['login'];
			$_SESSION['name']=$user['name'];
			redirect('home');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

}
