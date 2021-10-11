<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerModel extends CI_Model
{
    public function get_all()
    {
        $this->db->from('tb_user_customer');
        $this->db->order_by('nama','desc');
        return $this->db->get()->result();
    }  

    public function reset_password($id)
    {
        $data = array(
            'password' => md5('1234'),
        );

        $this->db->set($data);
        $this->db->where('id_customer', $id);
        $this->db->update('tb_user_customer', $data);
    }

}
