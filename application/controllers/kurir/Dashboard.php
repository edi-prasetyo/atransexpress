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
    $meta             = $this->meta_model->get_meta();
    // End Listing Berita dengan paginasi
    $data = array(
      'title'         => 'Dashboard',
      'deskripsi'     => 'Halaman Dashboard',
      'keywords'      => '',
      'content'       => 'kurir/dashboard/dashboard'
    );
    $this->load->view('kurir/layout/wrapp', $data, FALSE);
  }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
