<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shared extends CI_Controller {

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
		$this->load->model('m_shared');
		
	}
	public function index()
	{
		$metadata['controller']=$this;
		$metadata['list']=$this->m_shared->get_link();
		$shared=$this->m_shared->get_shares();
		$count=count($metadata["list"]["content"]);
		for ($i=0; $i < count($shared); $i++) { 
			$metadata["list"]["content"][$count]=$shared[$i];
			$count++;
		}

		$data['active']['shared']='active';
		$data['content']=$this->load->view('shared',$metadata,true);	
		//echo json_encode($metadata['list']);
		$this->load->view('main',$data);

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


	}