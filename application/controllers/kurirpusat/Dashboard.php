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
    $alltransaksi_kurirpusat         = $this->transaksi_model->get_allriwayat_kurirpusat($user_id);
    $count_alltransaksi_kurirpusat   = $this->transaksi_model->count_allriwayat_kurirpusat($user_id);
    // End Listing Berita dengan paginasi
    $data = array(
      'title'         => 'Dashboard',
      'deskripsi'     => 'Halaman Dashboard',
      'keywords'      => '',
      'alltransaksi_kurirpusat' => $alltransaksi_kurirpusat,
      'count_alltransaksi_kurirpusat' => $count_alltransaksi_kurirpusat,
      'content'       => 'kurirpusat/dashboard/dashboard'
    );
    $this->load->view('kurirpusat/layout/wrapp', $data, FALSE);
  }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
