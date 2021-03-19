<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  //listing Pendaftaran
  public function listUser()
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_admin()
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 1);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_agen()
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 4);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_agen_kota($kota_id)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->where(['role_id' => 4, 'kota_id' => $kota_id]);
    $this->db->or_where('role_id', 1);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_counter()
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 5);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_kurir($user_id, $kota_id)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(['id_agen' => $user_id, 'role_id' => 7, 'kota_id' => $kota_id]);
    $this->db->or_where('role_id', 6);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_kurir_agen($user_id)
  {
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(['id_agen' => $user_id, 'role_id' => 7]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function user_detail($user_id)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->where(
      ['user.id'    => $user_id]
    );
    $query = $this->db->get();
    return $query->row();
  }
  public function update($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->update('user', $data);
  }

  // Product User Read
  public function detail($id)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->where('user.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  // Mitra Agen
  public function get_counterByAgen()
  {
    $id_agen = $this->session->userdata('id');
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(['id_agen' => $id_agen, 'role_id' => 5]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // Kurir Agen
  public function get_kurirByAgen()
  {
    $id_agen = $this->session->userdata('id');
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->where(['user_create' => $id_agen, 'role_id' => 7]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
}
