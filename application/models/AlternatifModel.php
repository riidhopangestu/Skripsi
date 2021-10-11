<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlternatifModel extends CI_Model
{
    public function get_all()
    {
        $this->db->from('tb_alternatif');
        $this->db->order_by('id_alternatif');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->from('tb_alternatif');
        $this->db->where('id_alternatif', $id);
        return $this->db->get()->row(0);
    }

    public function get_nama_warga()
    {
        $this->db->select('tb_alternatif.fk_id_warga, tb_warga.id_warga, tb_warga.nama_warga, tb_alternatif.id_alternatif');
        $this->db->from('tb_alternatif');
        $this->db->join('tb_warga', 'tb_warga.id_warga = tb_alternatif.fk_id_warga');

        return $this->db->get()->result();
    }

    public function insert_alternatif()
    {
        $id = $this->input->post('fk_id_mekanik');
        
        $mekanik    = $this->db->from('tbl_mekanik');
        $mekanik    = $this->db->where('id', $id);
        $mekanik    = $this->db->get()->row(0);
        
        $data = array(
            'fk_id_mekanik' => $id,
            'nik_mekanik'=>$mekanik->nik,
            'nama_mekanik'=>$mekanik->nama
        );

        $this->db->insert('tb_alternatif', $data);
    }

    public function update_aletrnatif($id)  
    {
        $data = array(
            'fk_id_warga' => $this->input->post('fk_id_warga'),
        );

        $this->db->set($data);
        $this->db->where('id_alernatif', $id);
        $this->db->update('tb_alternatif', $data);
    }

    public function delete_by_id($id)
    {
        $this->db->where('id_alternatif', $id);
        $this->db->delete('tb_alternatif');
    }
}
