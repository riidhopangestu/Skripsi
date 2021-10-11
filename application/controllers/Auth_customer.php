<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_customer extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation', 'session');
		$this->load->model('AuthModel');
                $this->load->helper('ReaNumber_helper');
                
	}

	public function index()
	{       
                if ($this->session->userdata('cek_login') == TRUE && empty($this->session->userdata('fk_id_level'))) {
			redirect('site', 'refresh');
		}
                $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
                $data['login']= 1;
                
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/site/header');
                        $this->load->view('templates/site/navbar',$data);
			$this->load->view('customer_login/form_login');
			$this->load->view('templates/site/footer');
		} else {
			redirect('site', 'refresh');
		}
	}

	public function session_login()
	{
//                $this->session->sess_destroy();
		$this->session->unset_userdata('username');
                $this->session->unset_userdata('fk_id_level');
                $this->session->unset_userdata('nama_lengkap');
                $this->session->unset_userdata('id_user');
		$username = htmlspecialchars($this->input->post('username', true), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', true), ENT_QUOTES);

		$cek_user = $this->AuthModel->auth_loginCustomer($username, $password);
                
		if ($cek_user->num_rows() > 0) {
			$data = $cek_user->row_array();
			$this->session->set_userdata('cek_login', true);
				$this->session->set_userdata('nama_lengkap', $data['nama']);
                                $this->session->set_userdata('id_customer', $data['id_customer']);
				$this->session->set_userdata('username', $data['username']);
				redirect('site', 'refresh');
		} else {
			echo $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, isi data pengguna dengan benar!</div>');
		}
		redirect('auth_customer', 'refresh');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->unset_userdata('username');
		echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
		redirect('site', 'refresh');
	}
}
