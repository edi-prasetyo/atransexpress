<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lacak_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alllacak()
    {
        $this->db->select('*');
        $this->db->from('lacak');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_lacak($limit, $start)
    {
        $this->db->select('lacak.*, user.name');
        $this->db->from('lacak');
        $this->db->join('user', 'user.id = lacak.user_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function detail($id)
    {
        $this->db->select('*');
        $this->db->from('lacak');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Berita ke database
    public function create($data)
    {
        $this->db->insert('lacak', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function get_detail_lacak($id)
    {
        $this->db->select('lacak.*, provinsi.provinsi_name');
        $this->db->from('lacak');
        $this->db->join('provinsi', 'provinsi.id = lacak.provinsi_id', 'LEFT');
        $this->db->order_by('id', 'DESC');
        $this->db->where('transaksi_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function last_lacak($id)
    {
        $this->db->select('*');
        $this->db->from('lacak');
        //join
        // $this->db->join('mobil', 'mobil.id_mobil = lacak.id_mobil', 'left');
        //End Join
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('lacak', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('lacak', $data);
    }
}
