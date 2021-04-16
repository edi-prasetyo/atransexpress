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
    $meta             = $this->meta_model->get_meta();
    $alltransaksi_mainagen         = $this->transaksi_model->get_allriwayat_mainagen($user_id);
    $count_alltransaksi_mainagen   = $this->transaksi_model->count_allriwayat_mainagen($user_id);
    // End Listing Berita dengan paginasi
    $data = array(
      'title'         => 'Dashboard',
      'deskripsi'     => 'Halaman Dashboard',
      'keywords'      => '',
      'alltransaksi_mainagen'  => $alltransaksi_mainagen,
      'count_alltransaksi_mainagen' => $count_alltransaksi_mainagen,
      'content'       => 'mainagen/dashboard/dashboard'
    );
    $this->load->view('mainagen/layout/wrapp', $data, FALSE);
  }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
