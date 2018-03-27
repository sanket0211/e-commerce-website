<?php

class Example extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->library('image_lib');
	}

	// Store user information and send to profile page
	public function index() {
		$data['error'] = NULL;
		$this->load->view('home/example', $data);
	}

	public function img_upload() {
		var_dump($_FILES);
		die();
		$img_count = count($_FILES['userfile']['name']);
		for ($i=0; $i<$img_count; $i++) {
			$config['upload_path'] = './uploads/items';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']    = '5242880'; // 5 MB
			$config['max_width']  = '3840';
			$config['max_height']  = '3840';

			$_FILES['userfile']['name'] = $_FILES['userfile']['name'][$i];
			$_FILES['userfile']['type'] = $_FILES['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name'] = $_FILES['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error'] = $_FILES['userfile']['error'][$i];
			$_FILES['userfile']['size'] = $_FILES['userfile']['size'][$i];

			$this->upload->initialize($config);
			$this->upload->do_upload();
		}
	}
}
?>

