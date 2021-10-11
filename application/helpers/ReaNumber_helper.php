<?php

function getReaNumber($prefix, $no) {
    $number = sprintf('%04s', $no); // final result example: 0005
    return $prefix . $number;
}

function cart_draft($id) {
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query('select count(*) as total from tbl_service ts where status= 1 and created_by='.$id);
    $t = $query->row();    
    return $t->total;
}

function cart_status($id) {
    $ci=& get_instance();
    $ci->load->database();
    $query = $ci->db->query('select count(*) as total from tbl_service ts where status='.$id);
    $t = $query->row();    
    return $t->total;
}

