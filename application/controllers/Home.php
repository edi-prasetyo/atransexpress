<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('meta_model');
    $this->load->model('product_model');
    $this->load->model('galery_model');
    $this->load->model('kota_model');
  }
  public function index()
  {
    $meta                     = $this->meta_model->get_meta();
    $slider                   = $this->galery_model->slider();
    $kota_asal                = $this->kota_model->get_allkota();
    $kota_tujuan              = $this->kota_model->get_allkota();

    $data = array(
      'title'                 => $meta->title . ' - ' . $meta->tagline,
      'keywords'              => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
      'deskripsi'             => $meta->description,
      'slider'                => $slider,
      'kota_asal'             => $kota_asal,
      'kota_tujuan'           => $kota_tujuan,
      'content'               => 'front/home/index_home'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}
