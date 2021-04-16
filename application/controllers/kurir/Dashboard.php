<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('meta_model');
  }
  //main page - Berita
  public function index()
  {
    $user_id = $this->session->userdata('id');
    $alltransaksi_kurir         = $this->transaksi_model->get_allriwayat_kurir($user_id);
    $count_alltransaksi_kurir   = $this->transaksi_model->count_allriwayat_kurir($user_id);
    // End Listing Berita dengan paginasi
    $data = array(
      'title'         => 'Dashboard',
      'deskripsi'     => 'Halaman Dashboard',
      'keywords'      => '',
      'alltransaksi_kurir'  => $alltransaksi_kurir,
      'count_alltransaksi_kurir'  => $count_alltransaksi_kurir,
      'content'       => 'kurir/dashboard/dashboard'
    );
    $this->load->view('kurir/layout/wrapp', $data, FALSE);
  }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
