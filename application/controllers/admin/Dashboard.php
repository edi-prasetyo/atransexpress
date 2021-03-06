<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('transaksi_model');
    $this->load->model('kota_model');
    $this->load->model('topup_model');
  }
  public function index()
  {

    $total_topup                  = $this->topup_model->total_topup();
    $total_omset_transaksi        = $this->transaksi_model->get_total_omset_transaksi();


    $count_transaksi              = $this->transaksi_model->get_alltransaksi();
    $count_agen                   = $this->user_model->get_all_mainagen();
    $count_counter                = $this->user_model->get_allcounter();
    $count_kota                   = $this->kota_model->get_allkota();
    $list_user                    = $this->user_model->get_all();

    // Chart
    $alltransaksi         = $this->transaksi_model->get_chart_transaksi();
    $count_alltransaksi   = $this->transaksi_model->count_chart_transaksi();

    $data = [
      'title'                     => 'Dashboard',
      'list_user'                 => $list_user,
      'count_transaksi'           => $count_transaksi,
      'count_agen'                => $count_agen,
      'count_counter'             => $count_counter,
      'count_kota'                => $count_kota,
      'alltransaksi'              => $alltransaksi,
      'count_alltransaksi'        => $count_alltransaksi,
      'total_topup'               => $total_topup,
      'total_omset_transaksi'     => $total_omset_transaksi,
      'content'                   => 'admin/dashboard/dashboard'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
}
