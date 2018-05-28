<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('m_users');
		
	}
	public function index()
	{
		$user['data']= $this->m_users->get();
		$content['data']=$this->load->view('account',$user,true);
		$data['content']=$this->load->view('template/user_panel',$content,true);	
		$data['active']['account']='active';
		if (isset($_SESSION['token']) ) {
			$this->load->view('main',$data);
		}
	}

	public function detail()
	{
		$user['order']=$this->m_users->get_order();
		$user['data']= $this->m_users->get();
		$content['data']=$this->load->view('detail_account',$user,true);
		$data['content']=$this->load->view('template/user_panel',$content,true);	
		$data['active']['account']='active';
		if (isset($_SESSION['token']) ) {
			$this->load->view('main',$data);
		}
	}

	public function activity_log()
	{
		
	}

	public function update()
	{
		$this->m_users->change_profile($_POST);
		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Update profile successfully');
		redirect('users');
	}

	public function redeem_code()
	{
		$param['code']=$_POST['promo_code'];
		$result=$this->m_users->redeem_code($param);
		if ($result['code']=='PromoCodeNotFound') {
			$this->session->set_flashdata('message_type', 'danger');
			$this->session->set_flashdata('message', $result['description']);
		}
		else{
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('message', $result['description']);
		}
		
		redirect('users');
	}



}