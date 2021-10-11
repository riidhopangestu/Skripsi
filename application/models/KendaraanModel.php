<?php

defined('BASEPATH') or exit('No direct script access allowed');

class KendaraanModel extends CI_Model {

    function get_all_service() {
        $this->db->from('tbl_sevice');
        $this->db->where('status > 1');
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_kendaraan_by_customer($id) {
        $query = $this->db->query('select tk.*,tjk.nama as nama_jenis from tbl_kendaraan tk 
                                    left join tbl_jenis_kendaraan tjk on tjk.id = tk.jenis_id where tk.created_by=' .$id.' order by tk.created_at desc');
        return $query->result();
    }

    function get_by_id($id) {
        $query = $this->db->query('select tk.*,tjk.nama as nama_jenis from tbl_kendaraan tk 
                                    left join tbl_jenis_kendaraan tjk on tjk.id = tk.jenis_id  
                                    where tk.id=' . $id);
        return $query->row();
    }

    public function insert_kendaraan($data) {
        $this->db->trans_start();

        $this->db->insert('tbl_kendaraan', $data);
        $this->db->trans_complete();
    }

    public function update_kendaraan($data,$id) {

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('tbl_kendaraan', $data);
    }

    public function delete_kendaraan($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_kendaraan');
    }

}
