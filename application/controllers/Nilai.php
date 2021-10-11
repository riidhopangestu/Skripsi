<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->model('KriteriaModel');
        $this->load->model('NilaiModel');
        $this->load->model('mekanikModel');
        $this->load->helper('ReaNumber_helper');
        //validasi jika user belum login
        if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
            redirect('auth', 'refresh');
        }
    }

    public function detail_nilai($id_nilai) {
        $data['url'] = 'Nilai';
        $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();
        $data['nilai'] = $this->NilaiModel->get_detail_nilai($id_nilai);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('nilai/detail', $data);
        $this->load->view('templates/footer');
    }

    public function index() {
        $data['url'] = 'Nilai';
        $data['nilai'] = $this->NilaiModel->get_data_mekanik_from_nilai();

        $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('nilai/index', $data);
        $this->load->view('templates/footer');
    }

    public function insert() {
        $this->form_validation->set_rules('id_alternatif', 'ID / Nama Alternatif', 'trim|required');


        if ($this->form_validation->run() == false) {
            $data['url'] = 'Nilai';
            $data['data_kriteria'] = $this->NilaiModel->get_kriteria();
            $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('nilai/insert', $data);
            $this->load->view('templates/footer');
        } else {
            $id_mekanik = $this->input->post('id_alternatif');
            $cek_mekanik_nilai = $this->NilaiModel->cek_mekanik_nilai($id_mekanik);
            if($cek_mekanik_nilai == 0){
            $total_kriteria = count($_POST) - 1;

            foreach ($_POST as $key => $value) {
                if ($key != 'id_alternatif') {
                    $id_kriteria = substr($key, 1);
                    $data = [
                        'fk_id_mekanik' => $id_mekanik,
                        'fk_id_kriteria' => $id_kriteria,
                        'total_nilai' => $value,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>$this->session->userdata('id_user'),
                    ];

                    $this->NilaiModel->insert_nilai($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data gagal <b>ditambahkan</b>!</div>');
                }
            }
//                        die(var_dump($data));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>ditambahkan</b>!</div>');
            redirect('nilai', 'refresh');
        }else{
           $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal, data Sudah <b>Ada</b>!</div>');
            redirect('nilai', 'refresh'); 
        }
        }
    }

    public function update($id) {
        $this->form_validation->set_rules('total_nilai', 'Total Nilai', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['url'] = 'Nilai';
            $data['nilai'] = $this->NilaiModel->get_nilai_by_id($id);
//                        die(var_dump($data['nilai']));
            $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('nilai/update', $data);
            $this->load->view('templates/footer');
        } else {
            $this->NilaiModel->update_nilai($id);
            $data = $this->NilaiModel->get_nilai_by_id($id);
            redirect('nilai/detail_nilai/' . $data->fk_id_mekanik, 'refresh');
        }
    }

    public function delete($id) {
        $this->NilaiModel->delete_nilai($id);
        redirect('nilai', 'refresh');
    }

    public function delete_alternatif($id) {
        $this->NilaiModel->delete_nilai_by_alternatif($id);
        redirect('nilai', 'refresh');
    }

}
