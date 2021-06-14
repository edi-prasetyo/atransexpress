<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Destinasi_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function get_alldestinasi()
    {
        $this->db->select('*');
        $this->db->from('destinasi');
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_destinasi($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('destinasi');
        $this->db->limit($limit, $start);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_row()
    {
        $this->db->select('*');
        $this->db->from('destinasi');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }


    public function detail_destinasi($id)
    {
        $this->db->select('*');
        $this->db->from('destinasi');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    public function detail($destinasi_id)
    {
        $this->db->select('*');
        $this->db->from('destinasi');
        $this->db->where('id', $destinasi_id);
        $query = $this->db->get();
        return $query->row();
    }
    public function list_kota($destinasi_id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('destinasi_id', $destinasi_id);
        $this->db->order_by('kota.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
    // Create
    public function create($data)
    {
        $this->db->insert('destinasi', $data);
    }
    // Update
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('destinasi', $data);
    }
    //
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('destinasi', $data);
    }

    public function search_destinasi($kota_asal, $kota_tujuan)
    {
        $this->db->select('*');
        $this->db->from('destinasi');
        $this->db->where(['kota_asal' => $kota_asal, 'kota_tujuan' => $kota_tujuan]);
        $query = $this->db->get();
        return $query->row();
    }
}
