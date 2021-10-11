<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->helper('ReaNumber_helper');
        $this->load->model('ServiceModel');
        // $this->load->model('AlternatifModel');
        // $this->load->model('MetodeModel');
        $this->load->model('AlternatifModel');
        $this->load->model('KriteriaModel');
        $this->load->model('NilaiModel');
        $this->load->model('MetodeModel');

    }

    public function index() {
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        if ($this->session->userdata('cek_login') == TRUE && empty($this->session->userdata('fk_id_level'))) {
            $data['login'] = 1;
            $data['login_sesion'] = 1;
        }
        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('site/site');
        $this->load->view('templates/site/footer');
    }

    public function prosedur() {
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        if ($this->session->userdata('cek_login') == TRUE && empty($this->session->userdata('fk_id_level'))) {
            $data['login'] = 1;
            $data['login_sesion'] = 1;
        }
        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('site/prosedur');
        $this->load->view('templates/site/footer');
    }

    

    public function order() {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }

        $id = $this->session->userdata('id_customer');
        $data['url'] = 'service';
        $data['data'] = $this->ServiceModel->get_all_service_by_customer($id);
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        $data['login'] = 1;
        $data['login_sesion'] = 1;

        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('site/order');
        $this->load->view('templates/site/footer');
    }

    public function detail_order($id) {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }

        $data['url'] = 'Kriteria';
        $data['data'] = $this->ServiceModel->get_by_id($id);
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        $data['login'] = 1;
        $data['login_sesion'] = 1;

        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('site/detail_order');
        $this->load->view('templates/site/footer');
    }

    public function profile() {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }
        $id = $this->session->userdata('id_customer');
        $data['url'] = 'Kriteria';
        $data['data'] = $this->ServiceModel->get_user_id($id);
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        $data['login'] = 1;
        $data['login_sesion'] = 1;

        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('site/profile', $data);
        $this->load->view('templates/site/footer');
    }

    public function update_profile($id) {
        if ($this->session->userdata('cek_login') != TRUE|| !empty($this->session->userdata('fk_id_level')) ) {
            redirect('site', 'refresh');
        }
        $data['login'] = 1;
        $data['login_sesion'] = 1;
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Nama Wajib Diisi!']);
        $this->form_validation->set_rules('username', 'username', 'required', ['required' => 'Username Wajib Diisi!']);
        $this->form_validation->set_rules('email', 'email', 'required|valid_email', ['required' => 'email Wajib Diisi!', 'valid_email' => 'Email format Salah']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => 'alamat Wajib Diisi!']);
        $this->form_validation->set_rules('notlp', 'No Telepon', 'required', ['required|' => 'No Telepon Wajib Diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $id = $this->session->userdata('id_customer');
            $data['url'] = 'Kriteria';
            $data['data'] = $this->ServiceModel->get_user_id($id);
            $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
            $data['login'] = 1;
            $data['login_sesion'] = 1;

            $this->load->view('templates/site/header', $data);
            $this->load->view('templates/site/navbar', $data);
            $this->load->view('site/update_profile', $data);
            $this->load->view('templates/site/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'no_tlpn' => $this->input->post('notlp'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email')
            );
            $this->db->set($data);
            $this->db->where('id_customer', $id);
            $this->db->update('tb_user_customer', $data);
            echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile, Berhasil Di Update!</div>');
            redirect('site/profile/' . $id);
        }
    }

    public function update_password($id) {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }
        $this->form_validation->set_rules('passord_old', 'Password Lama', 'required', ['required' => 'Password Lama Wajib Diisi!']);
        $this->form_validation->set_rules('passord_new', 'Password Baru', 'required', ['required' => 'Password Baru Wajib Diisi!']);

        $cek_passord_old = $this->ServiceModel->get_user_id($id)->password;
        $passord_old = md5($this->input->post('passord_old'));
        if ($passord_old == $cek_passord_old) {
            $data = array(
                'password' => md5($this->input->post('passord_new')),
            );
            $this->db->set($data);
            $this->db->where('id_customer', $id);
            $this->db->update('tb_user_customer', $data);
            
            $this->session->sess_destroy();
            $this->session->unset_userdata('username');
            echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Di Ganti Silahkan Login kembali!</div>');
            redirect('auth_customer', 'refresh');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Passworrd lama, Salah gagal <b>diupdate</b>!</div>');
            redirect('site/profile', 'refresh');
        }
    }
    
    public function service() {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }
        $this->form_validation->set_rules('tanggal', 'Tanggal Estimasi', 'trim|required');
        $this->form_validation->set_rules('kendaraan', 'Kendaraanr', 'trim|required');
        $this->form_validation->set_rules('jenis_service', 'Jenis Service', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
            $data['login'] = 1;
            $data['login_sesion'] = 1;
            $data['mekanik'] = $this->get_mekanik();
            $this->load->view('templates/site/header', $data);
            $this->load->view('templates/site/navbar', $data);
            $this->load->view('site/service');
            $this->load->view('templates/site/footer');
        } else {
            
            $data['prefix'] = $this->ServiceModel->getLastOrderNo(date("Y-m-d"));
            $data['no'] = $this->ServiceModel->getLastNo(date("Y-m-d"));

            $this->ServiceModel->insert_service($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>ditambahkan</b>!</div>');
            redirect('site/order', 'refresh');
        }
    }
    
    public function update_order($id) {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }
        $this->form_validation->set_rules('tanggal', 'Tanggal Estimasi', 'trim|required');
        $this->form_validation->set_rules('kendaraan', 'Kendaraanr', 'trim|required');
        $this->form_validation->set_rules('jenis_service', 'Jenis Service', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['url'] = 'Kriteria';
            $data['data'] = $this->ServiceModel->get_by_id($id);
            $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
            $data['login'] = 1;
            $data['login_sesion'] = 1;

            $this->load->view('templates/site/header', $data);
            $this->load->view('templates/site/navbar', $data);
            $this->load->view('site/service_update', $data);
            $this->load->view('templates/site/footer');
        } else {
            $this->ServiceModel->update_service($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
            redirect('site/order', 'refresh');
        }
    }

    public function update_status_order($id) {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }

        $this->ServiceModel->update_status_order($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
        redirect('site/order', 'refresh');
    }

    public function delete_order($id) {
        if ($this->session->userdata('cek_login') != TRUE || !empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }
        $this->ServiceModel->delete_service($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data berhasil <b>dihapus</b>!</div>');
        redirect('site/order', 'refresh');
    }

    public function kontak() {
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        if ($this->session->userdata('cek_login') == TRUE && empty($this->session->userdata('fk_id_level'))) {
            $data['login'] = 1;
            $data['login_sesion'] = 1;
        }
        $this->load->view('templates/site/header', $data);
        $this->load->view('templates/site/navbar', $data);
        $this->load->view('site/kontak');
        $this->load->view('templates/site/footer');
    }

    public function register() {
        if ($this->session->userdata('cek_login') == TRUE && empty($this->session->userdata('fk_id_level'))) {
            redirect('site', 'refresh');
        }
        $data['session_login'] = $this->db->get_where('tb_user_customer', ['username' => $this->session->userdata('username')])->row_array();
        $data['login'] = 1;
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => 'Nama Wajib Diisi!']);
        $this->form_validation->set_rules('username', 'username', 'required', ['required' => 'Username Wajib Diisi!']);
        $this->form_validation->set_rules('email', 'email', 'required|valid_email', ['required' => 'email Wajib Diisi!', 'valid_email' => 'Email format Salah']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => 'alamat Wajib Diisi!']);
        $this->form_validation->set_rules('notlp', 'No Telepon', 'required', ['required|' => 'No Telepon Wajib Diisi!']);
        $this->form_validation->set_rules('password_1', 'password', 'required|matches[password_2]', ['required' => 'Password Wajib Diisi!', 'matches' => 'Password Tidak Sesuai!']);
        $this->form_validation->set_rules('password_2', 'password', 'required|matches[password_1]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/site/header', $data);
            $this->load->view('templates/site/navbar', $data);
            $this->load->view('site/register');
            $this->load->view('templates/site/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'no_tlpn' => $this->input->post('notlp'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password_1'))
            );

            $this->db->insert('tb_user_customer', $data);
            echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran, Sukses Silahkana Login!</div>');
            redirect('auth_customer');
        }
    }

    public function get_mekanik() {

        $get_data_nilai = $this->MetodeModel->get_data_nilai();
        if(empty($get_data_nilai)){
            return [];
        }
        $alternatif = [];
        foreach ($get_data_nilai as $key => $value) {
            $alternatif[$value->fk_id_mekanik] = $value;
        }

        $tranpose = [];
        foreach ($get_data_nilai as $key => $value) {
            $tranpose[$value->fk_id_kriteria][$value->fk_id_mekanik] = ['total' => $value->total_nilai, 'nama' => $value->nama, 'nik' => $value->nik, 'kode_kriteria' => $value->kode_kriteria, 'nama_kriteria' => $value->nama_kriteria, 'tipe_kriteria' => $value->tipe];
        }

        $sqrt = [];
        foreach ($tranpose as $key => $value) {

            $sum = 0;
            foreach ($value as $k => $v) {
                $sum += pow($v['total'], 2);
                $nama_kriteria = $v['nama_kriteria'];
                $kode_kriteria = $v['kode_kriteria'];
                $tipe_kriteria = $v['tipe_kriteria'];
            }
            $sqrt[$key] = ['total' => sqrt($sum), 'nama_kriteria' => $nama_kriteria, 'kode_kriteria' => $kode_kriteria, 'tipe_kriteria' => $tipe_kriteria];
        }

        $normalisasi = [];
        foreach ($tranpose as $key => $value) {
            foreach ($value as $k => $v) {
                $normalisasi[$key][$k] = ['total' => $v['total'] / $sqrt[$key]['total'], 'nama' => $v['nama'], 'nik' => $v['nik'], 'kode_kriteria' => $v['kode_kriteria'], 'tipe_kriteria' => $v['tipe_kriteria']];
            }
        }
     
        $kriteria = [];
        foreach ($this->db->get('tb_kriteria')->result() as $key => $value) {
            $kriteria[$value->id_kriteria] = $value;
        }

        $ternormalisasi = [];
        foreach ($normalisasi as $key => $value) {
            foreach ($value as $k => $v) {
                $ternormalisasi[$k][$key] = ['total' => $v['total'] * $kriteria[$key]->bobot, 'nama' => $v['nama'], 'nik' => $v['nik'], 'kode_kriteria' => $v['kode_kriteria'], 'tipe_kriteria' => $v['tipe_kriteria']];
            }
        }
       
        $max = [];
        $min = [];
        $tabel_yi = [];
        $nik = [];
        $nama_mekanik = [];
        foreach ($ternormalisasi as $key => $value) {
            $res = 0;
            $res2 = 0;
//                        die(var_dump($value));
            foreach ($value as $a => $b) {
                $nik_a = $b['nik'];
                $nama_mekanik_a = $b['nama'];
                if ($b['tipe_kriteria'] == 1) {
                    // $new_only_benefit[$a] = $b ;
                    $res += $b['total'];
                } else {
                    $res -= 0;
                }
                if ($kriteria[$a]->tipe == 0) {
                    // $new_only_benefit[$a] = $b ;
                    $res2 += $b['total'];
                } else {
                    $res2 -= 0;
                }
            }
            $max[$key] = $res;
            $min[$key] = $res2;
            $nik[$key] = $nik_a;
            $nama_mekanik[$key] = $nama_mekanik_a;
            $tabel_yi[$key] = ['nilai' => $res - $res2, 'nama_mekanik' => $nama_mekanik_a, 'nik' => $nik_a];
        }
       

        foreach ($tabel_yi as $key => $value) {
            $val[$key] = $value['nilai'];
        }


        $rankings = array_unique($val);
        rsort($rankings);

        $result_data = [];
        $i = 1;
        foreach ($rankings as $key => $value) {
            $result_data["" . $value] = $i;
            $i++;
        }


        $text_rank = [];
        foreach ($tabel_yi as $key => $value) {
            $val = $value['nilai'];
            $rank = $result_data["" . $val];
            $mekanik[$key]['value'] = $value['nilai'];
            $mekanik[$key]['rank'] = $rank;
            $mekanik[$key]['id_mekanik'] = $key;
            $mekanik[$key]['nama_mekanik'] = $value['nama_mekanik'];
            $mekanik[$key]['nik'] = $value['nik'];
            $text_rank[$key] = $mekanik[$key];
        }

        function compareOrder($a, $b) {
            return ($a['rank'] > $b['rank'] ? true : false);
        }

        usort($text_rank, 'compareOrder');

        return $text_rank;
    }

}
