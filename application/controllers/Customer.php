<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('CustomerModel');
        $this->load->helper('ReaNumber_helper');
        //validasi jika user belum login
        if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
            redirect('auth', 'refresh');
        }
    }

    public function index() {
        $data['url'] = 'Customer';
        $data['customer'] = $this->CustomerModel->get_all();

        $data['session_login'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('customer/index', $data);
        $this->load->view('templates/footer');
    }

    function reset_password($id) {

        $this->CustomerModel->reset_password($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, Password Customer berhasil <b>Direset</b>!</div>');
        redirect('customer', 'refresh');
    }

    public function export_excel() {
        $datas = $this->CustomerModel->get_all();
        
        $html ="<table border='1'>";
        $html .="<tr>";
        $html .="<td>NO</td>";
        $html .="<td>Nama</td>";
        $html .="<td>No Telepon</td>";
        $html .="<td>Email</td>";
        $html .="<td>Alamat</td>";
        $html .="</tr>";
        $i=1;
        foreach ($datas as $data){
        $html .="<tr>";
        $html .="<td>".$i++."</td>";
        $html .="<td>".$data->nama."</td>";
        $html .="<td>".$data->no_tlpn."</td>";
        $html .="<td>".$data->email."</td>";
        $html .="<td>".$data->alamat."</td>";
        $html .="</tr>";
        }

        $html .="</table>";
        
        echo $html;
        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_Customer.xls");
        exit;
    }

}
