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
  // Model for Admin
  public function get_all()
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

  public function get_all_mainagen()
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 4);
    $this->db->order_by('kota.kota_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_all_mainagen_active()
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->where(['role_id' => 4, 'is_active' => 1]);
    $this->db->order_by('kota.kota_name', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }

  // Main Agen
  public function get_mainagen($limit, $start, $search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name, provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->like('name', $search);
    $this->db->like('email', $search_email);
    $this->db->like('kota_name', $search_kota);
    // $this->db->like('name', $search);
    $this->db->where('role_id', 4);
    $this->db->limit($limit, $start);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_mainagen($search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name, provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->like('name', $search);
    $this->db->like('email', $search_email);
    $this->db->like('kota_name', $search_kota);
    // $this->db->like('name', $search);
    $this->db->where('role_id', 4);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function detail_mainagen($mainagen_id)
  {
    $this->db->select('user.*, user.name, user_role.role, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->where(
      ['user.id'    => $mainagen_id]
    );
    $query = $this->db->get();
    return $query->row();
  }
  // Kurir Pusat
  public function get_kurirpusat($limit, $start, $search)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->like('name', $search);
    $this->db->where('role_id', 6);
    $this->db->limit($limit, $start);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_kurirpusat($search)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->like('name', $search);
    $this->db->where('role_id', 6);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  // Kurir
  public function get_allkurir($limit, $start, $search)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->like('name', $search);
    $this->db->where('role_id', 7);
    $this->db->limit($limit, $start);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_allkurir($search)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->like('name', $search);
    $this->db->where('role_id', 7);
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  // Counter
  public function get_allcounter()
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 5);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // Counter Aktif
  public function get_allcounter_active()
  {
    $this->db->select('user.*, user_role.role, kota.kota_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    // End Join
    $this->db->where(['role_id' => 5, 'is_active' => 1, 'is_locked' => 1]);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_counter($limit, $start, $search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name, provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->where('role_id', 5);
    $this->db->like('name', $search);
    $this->db->like('email', $search_email);
    $this->db->like('kota_name', $search_kota);
    $this->db->limit($limit, $start);
    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function total_row_counter($search, $search_email, $search_kota)
  {
    $this->db->select('user.*, user_role.role, kota.kota_name, provinsi_name');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = user.provinsi_id', 'LEFT');
    // End Join
    $this->db->where('user.role_id', 5);
    $this->db->like('name', $search);
    $this->db->like('email', $search_email);
    $this->db->like('kota_name', $search_kota);

    $this->db->order_by('user.id', 'ASC');
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
    // $this->db->or_where('role_id', 1);
    $this->db->order_by('user.id', 'DESC');
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
    $this->db->where(['user_create' => $user_id, 'role_id' => 7]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function user_detail($user_id)
  {
    $this->db->select('user.*, user.name, user_role.role, kota.kota_name, provinsi.provinsi_name');
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
  public function get_counterByAgen($search)
  {
    $id_agen = $this->session->userdata('id');
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->like('name', $search);
    $this->db->where(['id_agen' => $id_agen, 'role_id' => 5]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // Kurir Agen
  public function get_kurirByAgen($search)
  {
    $id_agen = $this->session->userdata('id');
    $this->db->select('user.*, user_role.role');
    $this->db->from('user');
    // join
    $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
    // End Join
    $this->db->like('name', $search);
    $this->db->where(['user_create' => $id_agen, 'role_id' => 7]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_mainagen_name($parent_counter)
  {
    $this->db->select('user.*, kota.kota_name');
    $this->db->from('user');
    // Join
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    //End Join
    $this->db->where(['user.id' => $parent_counter]);

    $this->db->order_by('user.id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }

  public function detail_counter($counter_id)
  {
    $this->db->select('user.*, kota.kota_name');
    $this->db->from('user');
    // Join
    $this->db->join('kota', 'kota.id = user.kota_id', 'LEFT');
    //End Join
    $this->db->where('user.id', $counter_id);
    $query = $this->db->get();
    return $query->row();
  }
  public function counter_saya($user_id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where(['id_agen' => $user_id]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
}
