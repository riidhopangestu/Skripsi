<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function get_all()
    {
        $this->db->from('tb_user');
        $this->db->order_by('id_user');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->from('tb_user');
        $this->db->where('id_user', $id);
        return $this->db->get()->row(0);
    }

    public function insert()
    {
        $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'fk_id_level' => $this->input->post('role'),
        );
//        die(var_dump($data));
        $this->db->insert('tb_user', $data);    
    }

    public function update($id)
    {
        $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'fk_id_level' => $this->input->post('role'),
        );

        $this->db->set($data);
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('tb_user');
    }
}
