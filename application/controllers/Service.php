<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->model('ServiceModel');
        $this->load->model('AlternatifModel');
        $this->load->model('KriteriaModel');
        $this->load->model('NilaiModel');
        $this->load->model('MetodeModel');
        $this->load->helper('ReaNumber_helper');
        //validasi jika user belum login
        if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
            redirect('auth', 'refresh');
        }
    }

    public function index() {
        $data['url'] = 'Service';
        $data['data'] = $this->ServiceModel->get_all_service();
        $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('service/index', $data);
        $this->load->view('templates/footer');
    }

    public function View($id) {
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        if ($this->form_validation->run() == false) {

            $data['url'] = 'Service';
            $data['data'] = $this->ServiceModel->get_by_id($id);
//                        die(var_dump($data['data']));
            $data['mekanik'] = $this->get_mekanik();
            $data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('service/view', $data);
            $this->load->view('templates/footer');
        } else {
            if ($_POST['prosess'] == "reject") {
                $this->ServiceModel->reject($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
                redirect('service', 'refresh');
            } else {
                $status = $this->input->post('status');
                if($status == 2){
                    $cek_estimasi = $this->ServiceModel->get_by_id($id);
                    $id_mekanik = $this->input->post('mekanik');
                    $validasi_estimasi = $this->ServiceModel->validasi_estimasi($cek_estimasi->tgl_estimasi, $id_mekanik);
                
                    if ($validasi_estimasi->total < 2) {
                        $this->ServiceModel->update_status($id);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Estimasi Tanggal Mekanik Sudah ada!, Silahkan pilih Mekanik lain!</div>');
                    }
                    redirect('service', 'refresh');
                }else{
                   $this->ServiceModel->update_status($id);
                   $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>diupdate</b>!</div>');
                   redirect('service', 'refresh');
                }
            }
        }
    }

    function print_order($id) {
        $this->load->library('dompdf_gen');

        $data['data'] = $this->ServiceModel->get_by_id($id);

        $this->load->view('service/_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Invoice Order PDF", array('Attachment' => 0));
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
