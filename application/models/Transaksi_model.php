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
  public function get_transaksi($limit, $start)
  {
    $this->db->select('transaksi.*, user.name, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    // End Join
    // $this->db->where('stage', 6);
    $this->db->order_by('id', 'DESC');
    $this->db->limit($limit, $start);
    $query = $this->db->get();
    return $query->result();
  }
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
  //Total Berita Main Page
  public function total_row()
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
  public function detail($id)
  {
    $this->db->select('transaksi.*, user.counter_code, user.name, kota.kota_name, provinsi.provinsi_name');
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
  public function transaksi_detail($id)
  {
    $this->db->select('transaksi.*, user.counter_code, user.name, kota.kota_name, provinsi.provinsi_name');
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

    $this->db->select('transaksi.*, user.name, kota.kota_name, provinsi.provinsi_name');
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

  // MAIN AGEN
  public function get_transaksimycounter($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name, user.counter_code');
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

  public function kirim_ke_kurir($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['user_agen' => $user_id, 'stage' => 2]);
    // $this->db->or_where(['user_agen' => $user_id, 'stage' => 3]);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function get_transaksifromagen($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['to_agen' => $user_id, 'stage' => 5]);
    $this->db->or_where(['stage' => 6]);
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
  public function get_riwayat_mainagen($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['to_agen' => $user_id]);
    $this->db->or_where(['user_agen' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  public function get_row_mainagen($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['to_agen' => $user_id]);
    $this->db->or_where(['user_agen' => $user_id]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Riwayat Counter
  public function get_riwayat_counter($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['user_id' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }


  public function get_row_counter($user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['user_id' => $user_id]);

    $this->db->order_by('transaksi.id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  // Riwayat Kurir Pusat
  // Riwayat Counter
  public function get_riwayat_kurirpusat($limit, $start, $user_id)
  {
    $this->db->select('transaksi.*, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['kurir_pusat' => $user_id]);
    $this->db->limit($limit, $start);
    $this->db->order_by('transaksi.id', 'DESC');
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
    $this->db->where(['kurir_pusat' => $user_id]);

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

    $this->db->select('transaksi.*, user.name, kota.kota_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
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

    $this->db->select('transaksi.*, user.name, kota.kota_name, provinsi.provinsi_name');
    $this->db->from('transaksi');
    // Join
    $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
    $this->db->join('kota', 'kota.id = transaksi.kota_id', 'LEFT');
    $this->db->join('provinsi', 'provinsi.id = transaksi.provinsi_id', 'LEFT');
    //End Join
    $this->db->where(['stage' => 4, 'kurir_pusat' => $user_id]);
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
    $this->db->where(['stage' => 4, 'kurir_pusat' => $user_id]);

    if ($search != '') {
      $this->db->like('transaksi.kota_id', $search);
    }

    $query = $this->db->get();
    $this->db->order_by('transaksi.id', 'DESC');
    $result = $query->result_array();

    return $result[0]['allcount'];
  }
}
