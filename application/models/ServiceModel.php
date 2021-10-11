<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ServiceModel extends CI_Model {

    function get_all_service() {
         $query = $this->db->query('select tb.*,tm.nama as nama_mekanik, tjk.nama as nama_jenis_kendaraan, tjs.nama as nama_jenis_service
                                    from  tbl_service tb
                                    left join tbl_mekanik tm  on tm.id = tb.id_mekanik 
                                    left join tbl_jenis_kendaraan tjk  on tjk.id = tb.jenis_kendaraan_id 
                                    left join tbl_jenis_service tjs on tjs.id = tb.jenis_service_id order by tb.created_at desc');
        return $query->result();
    }

    function get_all_service_by_customer($id) {
        $query = $this->db->query('select tb.*,tm.nama as nama_mekanik, tjk.nama as nama_jenis_kendaraan, tjs.nama as nama_jenis_service
                                    from  tbl_service tb
                                    left join tbl_mekanik tm  on tm.id = tb.id_mekanik 
                                    left join tbl_jenis_kendaraan tjk  on tjk.id = tb.jenis_kendaraan_id 
                                    left join tbl_jenis_service tjs on tjs.id = tb.jenis_service_id
                                    where tb.created_by='.$id.' order by tb.created_at desc');
        return $query->result();
    }

    function get_by_id($id) {
        $query = $this->db->query('select tb.*,tm.nama as nama_mekanik, tjk.nama as nama_jenis_kendaraan, tjs.nama as nama_jenis_service 
                                    from  tbl_service tb
                                    left join tbl_mekanik tm  on tm.id = tb.id_mekanik 
                                    left join tbl_jenis_kendaraan tjk  on tjk.id = tb.jenis_kendaraan_id 
                                    left join tbl_jenis_service tjs on tjs.id = tb.jenis_service_id
                                    where tb.id='.$id);
        return $query->row();
    }

    public function insert_service($data) {
        $this->db->trans_start();
        
        $id = $this->session->userdata('id_customer');
        //cari data customer dulu
        $query1 = $this->db->from('tb_user_customer');
        $query1 = $this->db->where('id_customer', $id);
        $customer = $query1 = $this->db->get()->row();
        
        //cari data kendaraan
        $query2 = $this->db->from('tbl_kendaraan');
        $query2 = $this->db->where('id', $this->input->post('kendaraan'));
        $kendaraan = $query2 = $this->db->get()->row();
//        die(var_dump($kendaraan));
        
        $data = array(
            'prefik' => $data['prefix'],
            'no' => $data['no'],
            'nama' => $customer->nama,
            'email' => $customer->email,
            'no_tlpn' => $customer->no_tlpn,
            'alamat' => $customer->alamat,
            'plat_nomor'=>$kendaraan->plat_nomor,
            'kendaraan_id'=>$kendaraan->id,
            'jenis_kendaraan_id' => $kendaraan->jenis_id,
            'jenis_service_id' => $this->input->post('jenis_service'),
            // 'merek_kendaraan' => $kendaraan->merek,
            'nama_kendaraan' => $kendaraan->nama,
            'tahun_kendaraan' => $kendaraan->tahun,
            'gambar_kendaraan'=>$kendaraan->nama_file,
            'path_kendaraan'=>$kendaraan->path,
            'status' => 1,
            'id_mekanik'=>$this->input->post('mekanik'),
            'catatan' => $this->input->post('catatan'),
            'tgl_estimasi' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $this->session->userdata('id_customer'),
        );

        $this->db->insert('tbl_service', $data);
        $this->db->trans_complete();
    }

    public function update_service($id) {
       
        //cari data kendaraan
        $query2 = $this->db->from('tbl_kendaraan');
        $query2 = $this->db->where('id', $this->input->post('kendaraan'));
        $kendaraan = $query2 = $this->db->get()->row();
        
         $data = array(
            'plat_nomor'=>$kendaraan->plat_nomor,
            'kendaraan_id'=>$kendaraan->id,
            'jenis_kendaraan_id' => $kendaraan->jenis_id,
            'jenis_service_id' => $this->input->post('jenis_service'),
            // 'merek_kendaraan' => $kendaraan->merek,
            'nama_kendaraan' => $kendaraan->nama,
            'tahun_kendaraan' => $kendaraan->tahun,
            'gambar_kendaraan'=>$kendaraan->nama_file,
            'path_kendaraan'=>$kendaraan->path,
            'catatan' => $this->input->post('catatan'),
            'tgl_estimasi' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('tbl_service', $data);
    }

    public function update_status_order($id) {
        $this->db->from('tbl_service');
        $this->db->where('id', $id);
        $query = $this->db->get();

        $status = $query->row();
        $data = array(
            'status' => $status->status + 1,
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('tbl_service', $data);
    }

    public function delete_service($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_service');
    }

    public function getLastOrderNo($tglPengajuan) {
        $query = $this->db->query('SELECT count(*) as total FROM `tbl_service` WHERE YEAR(created_at) = "' . date('Y', strtotime($tglPengajuan)) . '" and MONTH(created_at) = "' . date('m', strtotime($tglPengajuan)) . '"');
        $t = $query->row();

        return "OR" . date('Y', strtotime($tglPengajuan)) . date('m', strtotime($tglPengajuan));
    }

    public function getLastNo($tglPengajuan) {
        $query = $this->db->query('SELECT count(*) as total FROM `tbl_service` WHERE YEAR(created_at) = "' . date('Y', strtotime($tglPengajuan)) . '" and MONTH(created_at) = "' . date('m', strtotime($tglPengajuan)) . '"');
        $t = $query->row();

        return $t->total + 1;
    }


    public function update_status($id) {
        $status = $this->input->post('status');
        if ($status == 2) { 
                $data = array(
                    'status' => $status + 1,
                    'id_mekanik'=>$this->input->post('mekanik'),
                    'catatan_admin'=>$this->input->post('catatan_admin'),
                );
       } else {
                $data = array(
                    'status' => $status + 1,
                );
       }
//       die();
       $this->db->set($data);
       $this->db->where('id', $id);
       $this->db->update('tbl_service', $data);
    }
    
    public function reject($id) {
       
        $data = array(
            'status' => 5,
            'catatan_admin'=>$this->input->post('catatan_admin'),
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('tbl_service', $data);
    }
    
    public function get_user_id($id){
        $this->db->from('tb_user_customer');
        $this->db->where('id_customer', $id);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function validasi_estimasi($tanggal,$id_mekanik){
         $query = $this->db->query('select count(*) as total from  tbl_service where tgl_estimasi="'.$tanggal.'" and id_mekanik='.$id_mekanik);
        return $query->row();
    }
 }
    