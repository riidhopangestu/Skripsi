<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{
    public function get_all_user()
    {
        $this->db->from('tb_user');
        $this->db->order_by('id_user');
        return $this->db->get()->result();
    }

    public function get_user_by_id($id_user)
    {
        $this->db->from('tb_user');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->row(0);
    }

    public function get_pie_chart()
    {
        $this->db->from('tbL_mekanik');
        return $this->db->get()->result();
    }
}
