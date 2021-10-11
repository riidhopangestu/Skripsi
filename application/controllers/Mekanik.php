<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mekanik extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation', 'session');
		$this->load->model('mekanikModel');
                 $this->load->helper('ReaNumber_helper');
		//validasi jika user belum login
		if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
			redirect('auth', 'refresh');
		}
	}

	public function index()
	{
		$data['url'] = 'Mekanik';
		$data['data_warga'] = $this->mekanikModel->get_all();
		$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('mekanik/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Mekanik', 'trim|required');
                $this->form_validation->set_rules('umur', 'Umur Mekanik', 'trim|required|numeric');
                $this->form_validation->set_rules('alamat', 'Alamat Mekanik', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['url'] = 'Mekanik';
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('mekanik/insert', $data);
			$this->load->view('templates/footer');
		} else {
			$this->mekanikModel->insert();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses data berhasil <b>ditambahkan</b>!</div>');
			redirect('mekanik', 'refresh');
		}
	}

	public function update($id)
	{
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama Mekanik', 'trim|required');
                $this->form_validation->set_rules('umur', 'Umur Mekanik', 'trim|required|numeric');
                $this->form_validation->set_rules('alamat', 'Alamat Mekanik', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$data['url'] = 'Mekanik';
			$data['data'] = $this->mekanikModel->get_by_id($id);
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('mekanik/update', $data);
			$this->load->view('templates/footer');
		} else {
			$this->mekanikModel->update($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses data berhasil <b>diupdate</b>!</div>');
			redirect('mekanik', 'refresh');
		}
	}

	public function delete($id)
	{
		$this->mekanikModel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data berhasil <b>dihapus</b>!</div>');
		redirect('mekanik', 'refresh');
	}

	public function export_excel()
	{
		$datas = $this->mekanikModel->get_all();

		$html ="<table border='1'>";
        $html .="<tr>";
        $html .="<td>NO</td>";
        $html .="<td>NIK</td>";
        $html .="<td>Nama</td>";
        $html .="<td>Umur</td>";
		$html .="<td>Alamat</td>";
        $html .="</tr>";
        $i=1;
        foreach ($datas as $data){
        $html .="<tr>";
        $html .="<td>".$i++."</td>";
        $html .="<td>".$data->nik."</td>";
        $html .="<td>".$data->nama."</td>";
        $html .="<td>".$data->umur."</td>";
		$html .="<td>".$data->alamat."</td>";
        $html .="</tr>";
        }

        $html .="</table>";
        
        echo $html;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_mekanik.xls");
        exit;
	}

}
