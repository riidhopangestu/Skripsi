<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Metode extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
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

	public function index()
	{
		$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();
		$data['url'] = 'Metode';

		$data['alternatif'] = $this->MetodeModel->get_nilai_setiap_alternatif();
		$data['kriteria'] = $this->MetodeModel->get_kriteria_by_id();
		$data['nilai'] = $this->MetodeModel->get_all_nilai();

		
        $get_data_nilai = $this->MetodeModel->get_data_nilai();

		$alternatif = [];
		foreach ($get_data_nilai as $key => $value) {
			$alternatif[$value->fk_id_mekanik] = $value;
		}

		$tranpose = [];
		foreach ($get_data_nilai as $key => $value) {
			$tranpose[$value->fk_id_kriteria][$value->fk_id_mekanik] =['total' => $value->total_nilai,'nama'=>$value->nama,'nik'=>$value->nik,'kode_kriteria'=>$value->kode_kriteria,'nama_kriteria'=>$value->nama_kriteria,'tipe_kriteria'=>$value->tipe];
                }

		$sqrt   = [];
		foreach ($tranpose as $key => $value) {
                      
			$sum = 0;
			foreach ($value as $k => $v) {
				$sum += pow($v['total'], 2);
                                $nama_kriteria =$v['nama_kriteria'];
                                $kode_kriteria =$v['kode_kriteria'];
                                $tipe_kriteria =$v['tipe_kriteria'];
			}
			$sqrt[$key] = ['total'=>sqrt($sum),'nama_kriteria'=>$nama_kriteria,'kode_kriteria'=>$kode_kriteria,'tipe_kriteria'=>$tipe_kriteria];
		}
		$data['sqrt'] = $sqrt;

		$normalisasi = [];
		foreach ($tranpose as $key => $value) {
			foreach ($value as $k => $v) {
				$normalisasi[$key][$k] = ['total'=>$v['total'] / $sqrt[$key]['total'],'nama'=>$v['nama'],'nik'=>$v['nik'],'kode_kriteria'=>$v['kode_kriteria'],'tipe_kriteria'=>$v['tipe_kriteria']];
			}
		}
		$data['normalisasi'] = $normalisasi;

//		 echo '<pre>';
//		 var_dump($normalisasi);
//		 die();

		$kriteria = [];
		foreach ($this->db->get('tb_kriteria')->result() as $key => $value) {
			$kriteria[$value->id_kriteria] = $value;
		}

		$ternormalisasi = [];
		foreach ($normalisasi as $key => $value) {
			foreach ($value as $k => $v) {
				$ternormalisasi[$k][$key] = ['total'=>$v['total'] * $kriteria[$key]->bobot,'nama'=>$v['nama'],'nik'=>$v['nik'],'kode_kriteria'=>$v['kode_kriteria'],'tipe_kriteria'=>$v['tipe_kriteria']];
			}
		}
		$data['ternormalisasi'] = $ternormalisasi;

		//  echo '<pre>';
		//  var_dump($ternormalisasi);
		// die();


		$max = [];
		$min = [];
		$tabel_yi = [];
                $nik =[];
                $nama_mekanik =[];
		foreach ($ternormalisasi as $key => $value) {
			$res = 0;
			$res2 = 0;

			foreach ($value as $a => $b) {
                                $nik_a = $b['nik'];
                                $nama_mekanik_a = $b['nama'];
				if ($b['tipe_kriteria'] == 1) {
					
					$res += $b['total'];
				} else {
					$res -= 0;
				}
				if ($kriteria[$a]->tipe == 0) {
					
					$res2 += $b['total'];
				} else {
					$res2 -= 0;
				}
			}
			$max[$key] = $res;
			$min[$key] = $res2;
                        $nik[$key] =$nik_a;
                        $nama_mekanik[$key] =$nama_mekanik_a;     
			$tabel_yi[$key] = $res - $res2;
		}
		$data['max'] = $max;
		$data['min'] = $min;
                $data['nik'] = $nik;
                $data['nama_mekanik'] = $nama_mekanik;
		$data['tabel_yi'] = $tabel_yi;
		


		$rankings = array_unique($tabel_yi);
		rsort($rankings);

		$result_data = [];
		$i = 1;
		foreach ($rankings as $key => $value) {
			$result_data["". $value] = $i;
			$i++;
		}
		

		$text_rank = [];
		foreach ($tabel_yi as $key => $value) {
			$rank = $result_data["". $value];
			$mekanik[$key]['value'] = $value;
			$mekanik[$key]['rank']= $rank;
                        $mekanik[$key]['id_mekanik']= $key;
			$text_rank[$key] = $mekanik[$key];
		}
                
		function compareOrder($a, $b)
		{
		return ($a['rank'] > $b['rank'] ? true : false);
		}
		usort($text_rank, 'compareOrder');
		$data['sorted_rank_data'] = $text_rank;
//		 echo '<pre>';
//		 var_dump($text_rank);
//		 die();




		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('metode/index', $data);
		$this->load->view('templates/footer');
	}
}
