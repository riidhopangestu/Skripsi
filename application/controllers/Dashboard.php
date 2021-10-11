<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('DashboardModel');
                $this->load->helper('ReaNumber_helper');
		//validasi jika user belum login
		if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
			redirect('auth', 'refresh');
		}
	}

	public function index()
	{
		$data['url'] = 'Dashboard';
		$data['get_user'] = $this->DashboardModel->get_all_user();
		$data['pie_chart'] = $this->DashboardModel->get_pie_chart();

		$data['session_login'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('index', $data);
		$this->load->view('templates/footer');
	}
}
