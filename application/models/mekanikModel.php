<?php
defined('BASEPATH') or exit('No direct script access allowed');

class mekanikModel extends CI_Model
{
    public function get_all()
    {
        $this->db->from('tbl_mekanik');
        $this->db->order_by('id');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->from('tbl_mekanik');
        $this->db->where('id', $id);
        return $this->db->get()->row(0);
    }

    public function insert()
    {
        $data = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'umur' => $this->input->post('umur'),
            'alamat' => $this->input->post('alamat'),
            'created_at'=>date('Y-m-d H:i:s'),
            'created_by'=>$this->session->userdata('id_user'),
        );
//        die(var_dump($data));
        $this->db->insert('tbl_mekanik', $data);    
    }

    public function update($id)
    {
        $data = array(
            'nik' => $this->input->post('nik'),
            'nama' => $this->input->post('nama'),
            'umur' => $this->input->post('umur'),
            'alamat' => $this->input->post('alamat'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'updated_by'=>$this->session->userdata('id_user'),
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('tbl_mekanik', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_mekanik');
    }
}
