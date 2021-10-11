<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_kendaraan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->helper('ReaNumber_helper');
        $this->load->helper('url', 'form');
        $this->load->model('KendaraanModel');
    }

    public function index() {
        if ($this->session->userdata('cek_login') != TRUE) {
            redirect('site', 'refresh');
        }
        $id = $this->session->userdata('id_customer');
        $data['url'] = 'service';
        $data['data'] = $this->KendaraanModel->get_all_kendaraan_by_customer($id);
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        $data['login'] = 1;
        $data['login_sesion'] = 1;

        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('data_kendaraan/index');
        $this->load->view('templates/site/footer');
    }

    public function insert() {
        if ($this->session->userdata('cek_login') != TRUE) {
            redirect('site', 'refresh');
        }

//        $this->form_validation->set_rules('gambar', 'Gambar Kendaraan', 'trim|required');
        $this->form_validation->set_rules('plat_nomor', 'Plat Nomor Kendaraan', 'trim|required');
        $this->form_validation->set_rules('jenis', 'Jenis Kendaraan', 'trim|required');
        $this->form_validation->set_rules('nama_kendaraan', 'Nama Kendaraan', 'trim|required');
        // $this->form_validation->set_rules('merek', 'Merek', 'trim|required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');


        if ($this->form_validation->run() == false) {
            $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
            $data['login'] = 1;
            $data['login_sesion'] = 1;
            $this->load->view('templates/site/header', $data);
            $this->load->view('templates/site/navbar', $data);
            $this->load->view('data_kendaraan/insert');
            $this->load->view('templates/site/footer');
        } else {
            if (empty($_FILES['gambar']["name"])) {
                $data = array(
                    'plat_nomor' => $this->input->post('plat_nomor'),
                        'nama' => $this->input->post('nama_kendaraan'),
                        'jenis_id' => $this->input->post('jenis'),
                        // 'merek' => $this->input->post('merek'),
                        'tahun' => $this->input->post('tahun'),
//                        'nama_file' => $data_image,
//                        'path' => $location,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_customer'),
                );
                $this->KendaraanModel->insert_kendaraan($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>ditambahkan</b>!</div>');
                redirect('data_kendaraan', 'refresh');
            } else {
                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1000;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    $data_image = $this->upload->data('file_name');
                    $location = base_url() . '/assets/upload/';

                    $data = array(
                        'plat_nomor' => $this->input->post('plat_nomor'),
                        'nama' => $this->input->post('nama_kendaraan'),
                        'jenis_id' => $this->input->post('jenis'),
                        // 'merek' => $this->input->post('merek'),
                        'tahun' => $this->input->post('tahun'),
                        'nama_file' => $data_image,
                        'path' => $location,
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->session->userdata('id_customer'),
                    );
                    $this->KendaraanModel->insert_kendaraan($data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>ditambahkan</b>!</div>');
                    redirect('data_kendaraan', 'refresh');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal, Menyimpan <b>data Kendaraan</b>!</div>');
                    redirect('data_kendaraan', 'refresh');
                }
            }
        }
    }

    public function update($id) {
        if ($this->session->userdata('cek_login') != TRUE) {
            redirect('site', 'refresh');
        }
        $this->form_validation->set_rules('plat_nomor', 'Plat Nomor Kendaraan', 'trim|required');
        $this->form_validation->set_rules('jenis', 'Jenis Kendaraan', 'trim|required');
        $this->form_validation->set_rules('nama_kendaraan', 'Nama Kendaraan', 'trim|required');
        // $this->form_validation->set_rules('merek', 'Merek', 'trim|required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['url'] = 'Kriteria';
            $data['data'] = $this->KendaraanModel->get_by_id($id);
            $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
            $data['login'] = 1;
            $data['login_sesion'] = 1;

            $this->load->view('templates/site/header', $data);
            $this->load->view('templates/site/navbar', $data);
            $this->load->view('data_kendaraan/update', $data);
            $this->load->view('templates/site/footer');
        } else {
//            die(var_dump($_FILES['gambar']["name"]));
            if (empty($_FILES['gambar']["name"])) {
                $data = array(
                    'plat_nomor' => $this->input->post('plat_nomor'),
                    'nama' => $this->input->post('nama_kendaraan'),
                    'jenis_id' => $this->input->post('jenis'),
                    // 'merek' => $this->input->post('merek'),
                    'tahun' => $this->input->post('tahun')
                );
                $this->KendaraanModel->update_kendaraan($data, $id);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
                redirect('data_kendaraan', 'refresh');
            } else {
                $data_kendaraan = $this->KendaraanModel->get_by_id($id);
                if($data_kendaraan->nama_file !==''){
                    $path = base_url() . 'assets/upload/' . $data_kendaraan->nama_file;
                    $dd = substr($path, strlen(base_url()));
                    unlink($dd);
                }
                $config['upload_path'] = './assets/upload/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 1000;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {

                    $data_image = $this->upload->data('file_name');
                    $location = base_url() . '/assets/upload/';

                    $data = array(
                        'plat_nomor' => $this->input->post('plat_nomor'),
                        'nama' => $this->input->post('nama_kendaraan'),
                        'jenis_id' => $this->input->post('jenis'),
                        // 'merek' => $this->input->post('merek'),
                        'tahun' => $this->input->post('tahun'),
                        'nama_file' => $data_image,
                        'path' => $location
                    );
                    $this->KendaraanModel->update_kendaraan($data, $id);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
                    redirect('data_kendaraan', 'refresh');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal, Update <b>data Kendaraan</b>!</div>');
                    redirect('data_kendaraan', 'refresh');
                }
            }
        }
    }

    public function delete($id) {
        if ($this->session->userdata('cek_login') != TRUE) {
            redirect('site', 'refresh');
        }
        $data_kendaraan = $this->KendaraanModel->get_by_id($id);
        $path = base_url() . 'assets/upload/' . $data_kendaraan->nama_file;
        $dd = substr($path, strlen(base_url()));
        unlink($dd);
//        die(var_dump($path));
        $this->KendaraanModel->delete_kendaraan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data berhasil <b>dihapus</b>!</div>');
        redirect('data_kendaraan', 'refresh');
    }

}
