<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MetodeModel extends CI_Model
{
    public function get_all_nilai()
    {
        $this->db->select('*');
        $this->db->from('tb_nilai');
        $this->db->order_by('id_nilai');
        return $this->db->get()->result();
    }
    public function get_data_nilai()
    {
        $this->db->select('tb_kriteria.tipe,tb_kriteria.kode_kriteria,tb_nilai.total_nilai, tbl_mekanik.nama, tb_kriteria.nama_kriteria,tbl_mekanik.nik, tb_nilai.fk_id_mekanik, tb_nilai.fk_id_kriteria, tb_nilai.id_nilai');
        $this->db->from('tb_nilai');
        $this->db->join('tbl_mekanik', 'tb_nilai.fk_id_mekanik = tbl_mekanik.id');
        $this->db->join('tb_kriteria', 'tb_nilai.fk_id_kriteria = tb_kriteria.id_kriteria');
        $this->db->order_by('id_nilai','asc');
        
        return $this->db->get()->result();
    }
    

    public function get_alternatif_by_id()
    {
        $this->db->order_by('id_alternatif', 'asc');
        $query = $this->db->get('tbl_mekanik');
        return $query->result();
    }

    function get_kriteria_by_id()
    {
        $this->db->order_by('id_kriteria', 'asc');
        $query = $this->db->get('tb_kriteria');
        return $query->result();
    }

    public function get_niai_setiap_alternatif($id_mekanik, $id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM tb_nilai WHERE fk_id_mekanik = '$id_mekanik' AND fk_id_kriteria = '$id_kriteria';");

        return $query->row_array();
    }

    public function get_data_penilaian($id_mekanik, $id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM tb_nilai WHERE fk_id_mekanik= '$id_mekanik' AND fk_id_kriteria = '$id_kriteria';");

        return $query->row_array();
    }

    public function get_nilai_setiap_alternatif()
    {
        $query = $this->db->query("SELECT DISTINCT tbl_mekanik.nama, tbl_mekanik.id, tbl_mekanik.nik FROM tbl_mekanik JOIN tb_nilai ON tbl_mekanik.id = tb_nilai.fk_id_mekanik order by id_nilai asc;");

        return $query->result();
    }

    public function normalisasi_nilai($id_kriteria) // optimasi nilai
    {
        $query = $this->db->query("SELECT SQRT(SUM(POWER(total_nilai, 2))) AS nilai_pembagian FROM tb_nilai WHERE fk_id_kriteria='$id_kriteria';");

        return $query->row_array();
    }

    public function pembobotan_nilai($id_kriteria) // pembobotan nilai
    {
        $query = $this->db->query("SELECT ((total_nilai / nilai_pembagian) * tb_kriteria.bobot) AS pembobotan_setiap_nilai, tb_kriteria.bobot, tb_kriteria.tipe 
		FROM tb_nilai JOIN (SELECT SQRT(SUM(POWER(total_nilai, 2))) AS nilai_pembagian FROM tb_nilai WHERE fk_id_kriteria='$id_kriteria') AS bobot_nilai 
		JOIN tb_kriteria ON tb_kriteria.id_kriteria = tb_nilai.fk_id_kriteria 
        WHERE tb_kriteria.id_kriteria='$id_kriteria' GROUP BY tb_nilai.fk_id_warga");

        return $query->row_array();
    }


    public function hasil_nilai($id_alternatif)
    {
        $query = $this->db->query("SELECT * FROM tb_alternatif WHERE id_alternatif='$id_alternatif';");
        return $query->row_array();
    }
}
