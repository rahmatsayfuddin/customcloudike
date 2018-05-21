<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->load->model('m_home');
		
	}
	public function index()
	{
		if (isset($_GET['path'])) {
			$param=$_GET['path'];
		}
		else{
			$param='';
		}
		$metadata['controller']=$this;
		$metadata['list']=$this->m_home->get_list($param);
		$data['content']=$this->load->view('home',$metadata,true);	
		$data['active']['all_files']='active';
		//echo json_encode($metadata['list']);
		$this->load->view('main',$data);

	}

	public function get_list()
	{
		if (isset($_GET['path'])) {
			$param=$_GET['path'];
		}
		else{
			$param='';
		}
		$metadata['list']=$this->m_home->get_list($param);
		echo json_encode($metadata['list']);

	}

	public function movecopy()
	{
		$param['to_path']=$_POST['to_path'];
		foreach ($_POST['from_path'] as $from_path) {
			$param['from_path'] = $from_path;
			echo json_encode($param);
			if($_POST["copy"]) {
				$this->m_home->copy($param);
			}
			if($_POST["move"]) {
				$this->m_home->move($param);
			}

		}

		if($_POST["copy"]) {

			$this->session->set_flashdata('message', 'Copy successfully');
		}
		if($_POST["move"]) {

			$this->session->set_flashdata('message', 'Move successfully');
		}
		$this->session->set_flashdata('message_type', 'success');
		redirect('?param='.$param['to_path']);		
	}



	public function search($value='')
	{
		if (isset($_GET['query'])) {
			$param='query='.$_GET['query'];
		}
		else{
			$param='';
		}
		$metadata['controller']=$this;
		$metadata['list']=$this->m_home->get_search($param);
		$metadata['list']['path']='/';
		$data['active']['search']='active';
		$data['content']=$this->load->view('home',$metadata,true);	
		//echo json_encode($metadata['list']['content']);
		$this->load->view('main',$data);

	}

	function icon( $mime_type ) {
  // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
		static $font_awesome_file_icon_classes = array(
    // Images
			'image' => 'fa-file-image-o',
    // Audio
			'audio' => 'fa-file-audio-o',
    // Video
			'video' => 'fa-file-video-o',
    // Documents
			'application/pdf' => 'fa-file-pdf-o',
			'text/plain' => 'fa-file-text-o',
			'text/html' => 'fa-file-code-o',
			'application/json' => 'fa-file-code-o',
    // Archives
			'application/gzip' => 'fa-file-archive-o',
			'application/zip' => 'fa-file-archive-o',
    // Misc
			'application/octet-stream' => 'fa-file-o',
			'application/vnd.android.package-archive'=> 'fa-android',
			'application/msword' => 'fa-file-word-o',
			'application/vnd.ms-excel'=>'fa-file-excel-o',
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'=>'fa-file-excel-o',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document'=>'fa-file-word-o',
			'application/vnd.ms-powerpoint'=>'fa-file-powerpoint-o',


		);
		if (isset($font_awesome_file_icon_classes[ $mime_type ])) {
			return $font_awesome_file_icon_classes[ $mime_type ];
		}
		$mime_parts = explode('/', $mime_type, 2);
		$mime_group = $mime_parts[0];
		if (isset($font_awesome_file_icon_classes[ $mime_group ])) {
			return $font_awesome_file_icon_classes[ $mime_group ];
		}
		return "fa-file-o";
	}


	function download($param='')
	{
		//echo base64_decode($param);
		$this->m_home->download(base64_decode($param));
	}

	public function prepare_share()
	{
		$param=$_POST['path'];
		$res=$this->m_home->prepare_share($param);
		echo json_encode($res);

	}
	public function others_create_link()
	{
		$param['path']=$_POST['path'];
		$this->m_home->others_create_link($param);
	}
	public function create_link()
	{
		$param['path']=$_POST['path'];
		$this->m_home->create_link($param);
	}

	public function delete_link()
	{
		$param['path']=$_POST['path'];
		$this->m_home->delete_link($param);
	}

	public function others_delete_link()
	{
		$param['path']=$_POST['path'];
		$this->m_home->others_delete_link($param);
	}

	function multiple_download()
	{
		//{"path":["/tesz","/bitcal.xlsx"],"is_win":true}
		$param['path']=$_GET['path'] ;
		$param['is_win']=true;
		//echo json_encode($param,JSON_UNESCAPED_SLASHES);
		//echo base64_decode($param);
		$this->m_home->multiple_download($param);
	}

	public function delete()
	{
		$param['path']=$_GET['path'] ;
		$this->m_home->delete($param);

		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Folder deleted successfully');
		redirect('home?path='.$_GET['base_path']);	

	}


	function create_folder()
	{
		//$param['path']=$_POST['path'].'/'.$_POST['folder_name'];
		$param['path']=str_replace("//","/",$_POST['path'].'/'.$_POST['folder_name']);
		$res=$this->m_home->create_folder($param);
		if (isset($res['code'])) {
			$this->session->set_flashdata('message_type', 'danger');
			$this->session->set_flashdata('message', $res['description']);
		}
		else{
			$this->session->set_flashdata('message_type', 'success');
			$this->session->set_flashdata('message', 'Folder created successfully');
		}
		//echo json_encode($param);
		redirect('home?path='.$_POST['path']);
	}

	public function rename()
	{
		$param['path']=$_POST['path'];
		$param['newname']=$_POST['newname'];
		//echo json_encode($param);
		$this->m_home->rename($param);

		$this->session->set_flashdata('message_type', 'success');
		$this->session->set_flashdata('message', 'Rename successfully');
		redirect('home');
	}

	function time2str($ts) {
		if(!ctype_digit($ts)) {
			$ts = strtotime($ts);
		}
		$diff = time() - $ts;
		if($diff == 0) {
			return 'now';
		} elseif($diff > 0) {
			$day_diff = floor($diff / 86400);
			if($day_diff == 0) {
				if($diff < 60) return 'just now';
				if($diff < 120) return '1 minute ago';
				if($diff < 3600) return floor($diff / 60) . ' minutes ago';
				if($diff < 7200) return '1 hour ago';
				if($diff < 86400) return floor($diff / 3600) . ' hours ago';
			}
			if($day_diff == 1) { return 'Yesterday'.date(' h:i:s A', $ts); }
			return date('d F Y h:i:s A', $ts);
		} else {
			$diff = abs($diff);
			$day_diff = floor($diff / 86400);
			if($day_diff == 0) {
				if($diff < 120) { return 'in a minute'; }
				if($diff < 3600) { return 'in ' . floor($diff / 60) . ' minutes'; }
				if($diff < 7200) { return 'in an hour'; }
				if($diff < 86400) { return 'in ' . floor($diff / 3600) . ' hours'; }
			}
			if($day_diff == 1) { return 'Tomorrow'; }
			if($day_diff < 4) { return date('l', $ts); }
			if($day_diff < 7 + (7 - date('w'))) { return 'next week'; }
			if(ceil($day_diff / 7) < 4) { return 'in ' . ceil($day_diff / 7) . ' weeks'; }
			if(date('n', $ts) == date('n') + 1) { return 'next month'; }
			return date('d F Y h:i:s A', $ts);
		}
	}


}
