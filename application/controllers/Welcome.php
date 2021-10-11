<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome/templates/header');
		$this->load->view('welcome/templates/topbar');
		$this->load->view('welcome/index');
		$this->load->view('welcome/templates/footer');
	}
}
