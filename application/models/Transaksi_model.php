<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
  //load database
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
  public function get_alltransaksi()
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  public function get_chart_transaksi()
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'DESC');
    $this->db->limit(7);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_chart_transaksi()
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $query = $this->db->get();
    return $query->result();
  }
  public function new_transaksi()
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    // $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(3);
    $query = $this->db->get();
    return $query->result();
  }
  public function product_home()
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->order_by('id', 'DESC');
    $this->db->limit(4);
    $query = $this->db->get();
    return $query->result();
  }
  // ------------------------------- Transaksi Belum di Ambil-----------------------------------//
  public function get_transaksi($limit, $start, $resi, $kota_asal, $kota_tujuan)
  {

    $this->db->select('transaksi.*, user.name, user_code, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->where('transaksi.stage', 1);
    $this->db->like('transaksi.nomor_resi', $resi);
    $this->db->like('transaksi.kota_from', $kota_asal);
    $this->db->like('transaksi.kota_to', $kota_tujuan);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Row
  public function total_row($resi, $kota_asal, $kota_tujuan)
  {

    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.stage', 1);
    $this->db->like('transaksi.nomor_resi', $resi);
    $this->db->like('transaksi.kota_from', $kota_asal);
    $this->db->like('transaksi.kota_to', $kota_tujuan);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // ------------------------------- END Transaksi Belum di Ambil-----------------------------------//

  // -------------------------------------Transaksi Proses------------------------------------------//
  public function get_transaksi_proses($limit, $start, $resi)
  {
    $stage = array('2', '3', '4', '5', '6', '7', '8');
    $this->db->select('transaksi.*, user.name, user_code, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->or_where_in('transaksi.stage', $stage);
    $this->db->like('nomor_resi', $resi);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Row
  public function total_row_proses($resi)
  {
    $stage = array('2', '3', '4', '5', '6', '7', '8');
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->or_where_in('transaksi.stage', $stage);
    $this->db->like('nomor_resi', $resi);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // -------------------------------------End Transaksi Proses------------------------------------------//

  // -------------------------------------Transaksi Selesai---------------------------------------------//
  public function get_transaksi_selesai($limit, $start, $resi)
  {
    $this->db->select('transaksi.*, user.name, user_code, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->or_where_in('transaksi.stage', 9);
    $this->db->like('nomor_resi', $resi);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Row
  public function total_row_selesai($resi)
  {

    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->or_where_in('transaksi.stage', 9);
    $this->db->like('nomor_resi', $resi);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // ------------------------------------End Transaksi Selesai------------------------------------------//

  // ------------------------------------=----Transaksi Batal-------------------------------------------//
  public function get_transaksi_batal($limit, $start, $resi)
  {
    $stage = array('1', '2', '3', '4', '5', '6', '7', '8');
    $this->db->select('transaksi.*, user.name, user_code, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->or_where_in('transaksi.stage', 10);
    $this->db->like('nomor_resi', $resi);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
  //Total Row
  public function total_row_batal($resi)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->or_where_in('transaksi.stage', 10);
    $this->db->like('nomor_resi', $resi);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }
  // ------------------------------------=-End Transaksi Batal-------------------------------------------//


  public function get_mytransaksi($id, $limit, $start)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where('user_id', $id);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function detail($id)
  {
    $this->db->select('transaksi.*, product.product_name, user.user_code, user.name, user.user_address, user.user_phone, kota.kota_name, provinsi.provinsi_name, category.category_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
    $this->db->join('product', 'product.id = transaksi.product_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function transaksi_detail($id)
  {
    $this->db->select('transaksi.*, user.user_code, user.name, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where('transaksi.id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  public function mytransaksi_detail($id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }
  //Kirim Data Berita ke database
  public function create($data)
  {
    $this->db->insert('transaksi', $data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  public function last_transaksi($id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    //join
    // $this->db->join('mobil', 'mobil.id_mobil = transaksi.id_mobil', 'left');
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
    $this->db->update('transaksi', $data);
  }
  //Hapus Data Dari Database
  public function delete($data)
  {
    $this->db->where('id', $data['id']);
    $this->db->delete('transaksi', $data);
  }

  public function transaksi($limit, $start)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where(['transaksi_status'     =>  'Aktif']);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function total()
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  // Pencarian Transaksi Admin
  public function getData_admin($rowno, $rowperpage, $search = "")
  {

    $this->db->select('transaksi.*, user.name, user.user_code, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join

    $this->db->order_by('transaksi.id', 'DESC');

    if ($search != '') {
      $this->db->like('transaksi.kota_id', $search);
    }

    $this->db->limit($rowperpage, $rowno);
    $query = $this->db->get();

    return $query->result_array();
  }

  // Select total records
  public function getrecordCount_admin($search = '')
  {

    $this->db->select('count(*) as allcount');
    $this->db->from('transaksi');


    if ($search != '') {
      $this->db->like('transaksi.kota_id', $search);
    }

    $query = $this->db->get();
    $this->db->order_by('transaksi.id', 'DESC');
    $result = $query->result_array();

    return $result[0]['allcount'];
  }


  // COUNTER AGEN 
  public function get_transaksi_counter($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    // End Join
    $this->db->where(['user_id' => $user_id, 'stage' => 1]);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // detail Transaksi Counter
  public function detail_counter($id, $user_id)
  {
    $this->db->select('transaksi.*, user.user_code, user.name, user.user_phone, kota.kota_name, provinsi.provinsi_name, product.product_name, category.category_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('product', 'product.id = transaksi.product_id', 'LEFT');
    $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
    //End Join
    $this->db->where(['transaksi.id' => $id, 'user_id' => $user_id]);
    $query = $this->db->get();
    return $query->row();
  }

  // detail Riwayat Main Agen
  public function detail_riwayat_mainagen($id, $user_id)
  {
    $this->db->select('transaksi.*, user.user_code, user.name,user.user_phone, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.kurir', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['transaksi.id' => $id, 'mainagen_id' => $user_id]);
    // $this->db->or_where(['mainagen_to_id' => $user_id]);
    $query = $this->db->get();
    return $query->row();
  }


  // MAIN AGEN
  public function get_transaksimycounter($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.user_code, user.user_address, user.user_phone');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where(['user_agen' => $user_id, 'stage' => 1]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function kirim_ke_kurir($user_id, $resi)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.name, user.user_phone, user.email');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('user', 'user.id = transaksi.kurir_stage', 'LEFT');

    //End Join
    $this->db->like('nomor_resi', $resi);
    $this->db->where(['user_stage' => $user_id]);
    // $this->db->or_where(['user_agen' => $user_id, 'stage' => 3]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }



  public function get_transaksidetailmycounter($user_id, $id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.user_code, user.user_address');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where(['user_agen' => $user_id, 'id' => $id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_transaksifromagen($user_id, $resi)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('user', 'user.id = transaksi.kurir', 'LEFT');
    //End Join
    $this->db->like('nomor_resi', $resi);
    $this->db->where(['to_agen' => $user_id, 'stage' => 5]);
    // $this->db->or_where(['user_stage' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Transaksi Kurir
  public function get_transaksi_kurir($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['kurir' => $user_id, 'stage' => 7]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Dikirim Kurir
  public function get_transaksi_kirim($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['kurir' => $user_id, 'stage' => 8]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Riwayat Main Agen 
  public function get_riwayat_mainagen($limit, $start, $user_id, $search)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.user_code, user.user_address');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->like('nomor_resi', $search);
    //End Join
    $this->db->where(['mainagen_id' => $user_id]);
    $this->db->or_where(['mainagen_to_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Riwayat Main Agen
  public function get_allriwayat_mainagen($user_id)
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->where(['mainagen_id' => $user_id]);
    $this->db->or_where(['mainagen_to_id' => $user_id]);
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'DESC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }

  public function count_allriwayat_mainagen($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['mainagen_id' => $user_id]);
    $this->db->or_where(['mainagen_to_id' => $user_id]);
    $query = $this->db->get();
    return $query->result();
  }


  public function get_row_mainagen($user_id, $search)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->like('nomor_resi', $search);
    $this->db->where(['mainagen_id' => $user_id]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Riwayat Counter
  public function get_riwayat_counter($limit, $start, $user_id, $search)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->like('nomor_resi', $search);
    $this->db->where(['counter_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // public function get_allriwayat_counter($user_id)
  // {
  //   $this->db->select('transaksi.*, COUNT(id) AS total');

  //   $this->db->from('transaksi');
  //   $this->db->where(['counter_id' => $user_id]);
  //   $this->db->group_by(['total' => 'DATE(date_created)']);
  //   $this->db->order_by('DATE(date_created)', 'ASC');
  //   $this->db->limit(12);
  //   $query = $this->db->get();
  //   return $query->result();
  // }
  public function get_allriwayat_counter($user_id)
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->where(['counter_id' => $user_id]);
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'DESC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_allriwayat_counter($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['counter_id' => $user_id]);
    $query = $this->db->get();
    return $query->result();
  }


  public function get_row_counter($user_id, $search)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->like('nomor_resi', $search);
    $this->db->where(['counter_id' => $user_id]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  // Riwayat Kurir Pusat
  public function get_riwayat_kurirpusat($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['kurirpusat_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  public function get_allriwayat_kurirpusat($user_id)
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->where(['kurirpusat_id' => $user_id]);
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'ASC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_allriwayat_kurirpusat($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['kurirpusat_id' => $user_id]);
    $query = $this->db->get();
    return $query->result();
  }


  public function get_row_kurirpusat($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['kurirpusat_id' => $user_id]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Riwayat Kurir
  public function get_riwayat_kurir($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.user_code, user.user_address');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->where(['kurir_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  public function get_allriwayat_kurir($user_id)
  {
    $this->db->select('transaksi.*, COUNT(transaksi.id) AS total');
    $this->db->from('transaksi');
    $this->db->where(['kurir_id' => $user_id]);
    $this->db->group_by('DATE(date_created)');
    $this->db->order_by('DATE(date_created)', 'ASC');
    $this->db->limit(12);
    $query = $this->db->get();
    return $query->result();
  }
  public function count_allriwayat_kurir($user_id)
  {
    $this->db->select('*');
    $this->db->from('transaksi');
    $this->db->where(['kurir_id' => $user_id]);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_row_kurir($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['kurir_id' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  // KURIR PUSAT
  public function get_kurirpusat($limit, $start)
  {
    $this->db->select('transaksi.*, user.name, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->where('stage', 6);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function get_kurirpusat_kirim($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, user.name, user.user_code, user.user_address, user.user_phone, user.email, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.to_agen', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['user_stage' => $user_id]);
    // $this->db->or_where(['stage' => 5, 'kurirpusat_id' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  public function total_row_kirim($user_id)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->like('kurir_pusat', $user_id);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_kirim($limit, $start)
  {
    $this->db->select('transaksi.*, user.name, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->where('stage', 9);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }

  // Get Data Transaksi Kurir Pusat
  public function get_transaksi_kurirpusat($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, user.name, user.user_code, user.user_phone, user.user_address, kota.kota_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_agen', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    $this->db->where(['stage' => 3, 'kurir_pusat' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');
    $this->db->limit($limit, $start, $user_id);
    $query = $this->db->get();
    return $query->result();
  }

  // Total Row Kurir Pusat
  public function total_row_kurirpusat($user_id)
  {
    $this->db->select('transaksi.*, user.name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    //End Join
    $this->db->like('kurir_pusat', $user_id);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Fungsi Pencarian


  // Select total records
  // public function getrecordCountIklan()
  // {

  //   $this->db->select('count(*) as allcount');
  //   $this->db->from('transaksi');
  //   $this->db->order_by('transaksi.id', 'DESC');
  //   $query = $this->db->get();
  //   $result = $query->result_array();

  //   return $result[0]['allcount'];
  // }

  // Fetch records Index

  public function getData($user_id, $rowno, $rowperpage, $search = "")
  {

    $this->db->select('transaksi.*, user.name, user.user_code, user.user_phone, user.user_address, kota.kota_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_agen', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    //End Join
    $this->db->where(['stage' => 3, 'kurir_pusat' => $user_id]);
    $this->db->order_by('transaksi.id', 'DESC');

    if ($search != '') {
      $this->db->like('kota_from', $search);
    }

    $this->db->limit($rowperpage, $rowno);
    $query = $this->db->get();

    return $query->result_array();
  }

  // Select total records
  public function getrecordCount($user_id, $search = '')
  {

    $this->db->select('count(*) as allcount');
    $this->db->from('transaksi');
    $this->db->where(['stage' => 3, 'kurir_pusat' => $user_id]);

    if ($search != '') {
      $this->db->like('kota_from', $search);
    }

    $query = $this->db->get();
    $this->db->order_by('transaksi.id', 'DESC');
    $result = $query->result_array();

    return $result[0]['allcount'];
  }

  // Fetch records Pengiriman

  public function getDatakirim($user_id, $rowno, $rowperpage, $search = "")
  {

    $this->db->select('transaksi.*, user.name, user.user_code, user.user_address, user.user_phone, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.to_agen', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['user_stage' => $user_id]);
    // $this->db->or_where(['stage' => 5, 'kurirpusat_id' => $user_id]);

    $this->db->order_by('transaksi.id', 'DESC');

    if ($search != '') {
      $this->db->like('transaksi.kota_id', $search);
    }

    $this->db->limit($rowperpage, $rowno);
    $query = $this->db->get();

    return $query->result_array();
  }

  // Select total records
  public function getrecordCountkirim($user_id, $search = '')
  {

    $this->db->select('count(*) as allcount');
    $this->db->from('transaksi');
    $this->db->where(['stage' => 4, 'kurirpusat_id' => $user_id]);
    // $this->db->or_where(['kurirpusat_id' => $user_id]);

    if ($search != '') {
      $this->db->like('transaksi.kota_id', $search);
    }

    $query = $this->db->get();
    $this->db->order_by('transaksi.id', 'DESC');
    $result = $query->result_array();

    return $result[0]['allcount'];
  }


  // Front
  public function get_resi($nomor_resi)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['nomor_resi' => $nomor_resi]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->row();
  }
}
