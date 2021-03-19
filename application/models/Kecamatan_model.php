<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function get_kecamatan()
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_kecamatan($id)
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->where(['id', $id]);
        $query = $this->db->get();
        return $query->row();
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('kecamatan', $data);
    }
}
