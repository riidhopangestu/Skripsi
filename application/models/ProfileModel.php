<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileModel extends CI_Model
{

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->order_by('id_user');
        return $this->db->get()->result();
    }

    public function get_user_by_id($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row(0);
    }

}
