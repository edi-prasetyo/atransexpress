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
  }
  public function index()
  {
    $meta                     = $this->meta_model->get_meta();
    $slider                   = $this->galery_model->slider();
    $data = array(
      'title'                 => $meta->title . ' - ' . $meta->tagline,
      'keywords'              => $meta->title . ' - ' . $meta->tagline . ',' . $meta->keywords,
      'deskripsi'             => $meta->description,
      'slider'                =>  $slider,
      'content'               => 'front/home/index_home'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}
