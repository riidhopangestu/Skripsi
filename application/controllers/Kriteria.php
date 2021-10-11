<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation', 'session');
		$this->load->model('KriteriaModel');
                 $this->load->helper('ReaNumber_helper');
		//validasi jika user belum login
		if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
			redirect('auth', 'refresh');
		}
	}

	public function index()
	{
		$data['url'] = 'Kriteria';
		$data['data'] = $this->KriteriaModel->get_all_kriteria();
		$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('kriteria/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['url'] = 'Kriteria';
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('kriteria/insert', $data);
			$this->load->view('templates/footer');
		} else {
			$this->KriteriaModel->insert_kriteria();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>ditambahkan</b>!</div>');
			redirect('kriteria', 'refresh');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nama_kriteria', 'Nama Kriteria', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['url'] = 'Kriteria';
			$data['data'] = $this->KriteriaModel->get_by_id($id);
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('kriteria/update', $data);
			$this->load->view('templates/footer');
		} else {
			$this->KriteriaModel->update_kriteria($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
			redirect('kriteria', 'refresh');
		}
	}

	public function delete($id)
	{
		$this->KriteriaModel->delete_kriteria($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data berhasil <b>dihapus</b>!</div>');
		redirect('kriteria', 'refresh');
	}

	
}
