<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->model('ProfileModel');
        $this->load->helper('ReaNumber_helper');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique' => 'Maaf, email ini sudah digunakan!'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tb_user.username]', [
            'is_unique' => 'Maaf username ini sudah digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Maaf password tidak sama!',
            'min_length' => 'Maaf, password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {

            $data['url'] = 'Profile';
            $data['user'] = $this->ProfileModel->get_all_user();
            $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('profile', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password1'), PASSWORD_DEFAULT),
            ];

            $this->db->set($data);
            $this->db->where('id_user');
            $this->db->update('tb_user', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses! akun berhasil diupdate!</div>');
			redirect('Dashboard');
        }
    }
}
