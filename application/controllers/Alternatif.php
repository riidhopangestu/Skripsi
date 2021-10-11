<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('AlternatifModel');
		$this->load->helper('url', 'form');
                 $this->load->helper('ReaNumber_helper');
		//validasi jika user belum login
		if ($this->session->userdata('cek_login') != TRUE || empty($this->session->userdata('fk_id_level'))) {
			redirect('auth', 'refresh');
		}
	}

	public function index()
	{
		$data['url'] = 'Alternatif';
		$data['data_alternatif'] = $this->AlternatifModel->get_all();

		$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar', $data);
		$this->load->view('alternatif/index', $data);
		$this->load->view('templates/footer');
	}

	public function insert()
	{
		$this->form_validation->set_rules('fk_id_mekanik', 'ID Mekanik', 'trim|required');

		if ($this->form_validation->run() == false) {
			$data['url'] = 'Alternatif';
			$data['session_login'] = $this->db->get_where('tb_user', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->row_array();

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/navbar', $data);
			$this->load->view('alternatif/insert', $data);
			$this->load->view('templates/footer');
		} else {
			$this->AlternatifModel->insert_alternatif();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses, data berhasil <b>ditambahkan</b>!</div>');
			redirect('alternatif', 'refresh');
		}
	}

	public function delete($id)
	{
		$this->AlternatifModel->delete_by_id($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sukses, data berhasil <b>dihapus</b>!</div>');
		redirect('alternatif', 'refresh');
	}

	public function export_excel()
	{
		$data['data_kriteria'] = $this->KriteriaModel->get_all_kriteria();

		require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
		require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');
		require(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php');

		$kriteriaPHPExcel = new PHPExcel();

		$kriteriaPHPExcel->getProperties()->setCreator("Kristina");
		$kriteriaPHPExcel->getProperties()->setLastModifiedBy("Kristina");
		$kriteriaPHPExcel->getProperties()->setTitle("Data Kriteria");
		$kriteriaPHPExcel->getProperties()->setSubject("");
		$kriteriaPHPExcel->getProperties()->setDescription("");

		$kriteriaPHPExcel->setActiveSheetIndex(0);

		$kriteriaPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
		$kriteriaPHPExcel->getActiveSheet()->setCellValue('B1', 'Nama Kriteria');
		$kriteriaPHPExcel->getActiveSheet()->setCellValue('C1', 'Tipe');
		$kriteriaPHPExcel->getActiveSheet()->setCellValue('D1', 'Bobot');

		$baris = 2;
		$x = 1;

		foreach ($data['data_kriteria'] as $data) {
			$kriteriaPHPExcel->getActiveSheet()->setCellValue('A' . $baris, $x++);
			$kriteriaPHPExcel->getActiveSheet()->setCellValue('B' . $baris, $data->nama_kriteria);
			$kriteriaPHPExcel->getActiveSheet()->setCellValue('C' . $baris, $data->tipe);
			$kriteriaPHPExcel->getActiveSheet()->setCellValue('D' . $baris, $data->bobot);

			$baris++;
		}

		$filename = "Data Kriteria" . date("d-m-Y-H-i-s") . '.xlsx';

		$kriteriaPHPExcel->getACtiveSheet()->setTitle("Data Kriteria");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age = 0');

		$writer = PHPExcel_IOFactory::createWriter($kriteriaPHPExcel, 'Excel2007');
		$writer->save('php://output');

		exit;
	}

	public function export_pdf()
	{
		$this->load->library('dompdf_gen');

		$data['data_kriteria'] = $this->KriteriaModel->get_all_kriteria();

		$this->load->view('kriteria/pdf_kriteria', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan Kriteria PDF", array('Attachment' => 0));
	}
}
