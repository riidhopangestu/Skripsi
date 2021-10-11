<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    public function auth_login($username,$password){
        $query=$this->db->query("SELECT * FROM tb_user WHERE username='$username' AND password=md5('$password') LIMIT 1");
        return $query;
    }
    public function auth_loginCustomer($username,$password){
        $query=$this->db->query("SELECT * FROM tb_user_customer WHERE username='$username' AND password=md5('$password') LIMIT 1");
        return $query;
    }
    
}
