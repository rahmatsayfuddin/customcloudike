<?php 
$this->load->view('template/header');
$this->load->view('template/sidebar',$active);
echo $content;
$this->load->view('template/footer');
?>