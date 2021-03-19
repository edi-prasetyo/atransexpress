<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galery extends CI_Controller
{
  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('galery_model');
    $this->load->model('meta_model');
    $this->load->library('pagination');
  }
  //main page - Galery
  public function index()
  {
    $meta                           = $this->meta_model->get_meta();
    // Listing Galery Dengan Pagination
    $this->load->library('pagination');
    $config['base_url']             = base_url('galery/index/');
    $config['total_rows']           = count($this->galery_model->total());
    $config['per_page']             = 3;
    $config['uri_segment']          = 4;
    //Limit dan Start
    $limit                          = $config['per_page'];
    $start                          = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);
    $galery                         = $this->galery_model->galery($limit, $start);
    // End Listing Galery dengan paginasi
    $data = array(
      'title'                       => 'Galery - ' . $meta->title,
      'deskripsi'                   => 'Galery - ' . $meta->description,
      'keywords'                    => 'Galery - ' . $meta->keywords,
      'paginasi'                    => $this->pagination->create_links(),
      'galery'                      => $galery,
      'content'                     => 'front/galery/index_galery'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  //main page - detail Galery
  public function detail($galery_slug = NULL)
  {
    if (!empty($galery_slug)) {
      $galery_slug;
    } else {
      redirect(base_url('galery'));
    }
    $galery                         = $this->galery_model->read($galery_slug);
    $data                           = array(
      'title'                       => $galery->galery_title,
      'deskripsi'                   => $galery->galery_title,
      'keywords'                    => $galery->galery_keywords,
      'galery'                      => $galery,
      'tanggal_post'                => date('Y-m-d H:i:s'),
      'content'                     => 'front/galery/detail_galery'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
 
}

/* End of file Galery.php */
/* Location: ./application/controllers/Galery.php */
