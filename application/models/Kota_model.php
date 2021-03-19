<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function get_kota()
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allkota()
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_kota($id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where(['id', $id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function kota_by_provinsi($provinsi_id)
    {
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where(['id', $provinsi_id]);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Create
    public function create($data)
    {
        $this->db->insert('kota', $data);
    }
    // Update
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('kota', $data);
    }
    //
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('kota', $data);
    }
}
