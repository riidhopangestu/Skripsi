<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation', 'session');
		$this->load->model('UserModel');
                $this->load->helper('ReaNumber_helper');
		//validasi jika user belum login
		if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
			redirect('auth', 'refresh');
		}
	}

	public function index()
	{
		$data['url'] = 'User';
		$data['data_user'] = $this->UserModel->get_all();
		$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('role', 'role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['url'] = 'User';
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('user/insert', $data);
			$this->load->view('templates/footer');
		} else {
			$this->UserModel->insert();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses data berhasil <b>ditambahkan</b>!</div>');
			redirect('user', 'refresh');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $this->form_validation->set_rules('role', 'role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['url'] = 'Mekanik';
			$data['data'] = $this->UserModel->get_by_id($id);
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('user/update', $data);
			$this->load->view('templates/footer');
		} else {
			$this->UserModel->update($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses data berhasil <b>diupdate</b>!</div>');
			redirect('user', 'refresh');
		}
	}

	public function delete($id)
	{
		$this->UserModel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data berhasil <b>dihapus</b>!</div>');
		redirect('user', 'refresh');
	}

	public function export_excel()
	{
		$datas = $this->UserModel->get_all();
        $html ="<table border='1'>";
        $html .="<tr>";
        $html .="<td>NO</td>";
        $html .="<td>Username</td>";
        $html .="<td>Nama</td>";
        $html .="<td>Email</td>";
        $html .="</tr>";
        $i=1;
        foreach ($datas as $data){
        $html .="<tr>";
        $html .="<td>".$i++."</td>";
        $html .="<td>".$data->username."</td>";
        $html .="<td>".$data->nama_lengkap."</td>";
        $html .="<td>".$data->email."</td>";
        $html .="</tr>";
        }

        $html .="</table>";
        
        echo $html;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_user.xls");
        exit;
	}

}
