<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi extends CI_Controller
{
  //load data
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->model('transaksi_model');
    $this->load->model('lacak_model');
    $this->load->model('provinsi_model');
    $this->load->model('kota_model');
    $this->load->model('main_model');
  }

  //INDEX TRANSAKSI BELUM DI AMBIL ************************************************************************************/
  public function index()
  {
    $resi = $this->input->post('resi');
    $list_kota_asal   = $this->kota_model->get_allkota();
    $list_kota_tujuan = $this->kota_model->get_allkota();

    // Pencarian
    $kota_asal    = $this->input->post('kota_asal');
    $kota_tujuan  = $this->input->post('kota_tujuan');
    // var_dump($kota_tujuan);
    // die;

    $config['base_url']         = base_url('admin/transaksi/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row($resi, $kota_asal, $kota_tujuan));
    $config['per_page']         = 10;
    $config['uri_segment']      = 4;
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi($limit, $start, $resi, $kota_asal, $kota_tujuan);
    // var_dump($transaksi);
    // die;
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'list_kota_asal'        => $list_kota_asal,
      'list_kota_tujuan'      => $list_kota_tujuan,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/index_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI BELUM DI AMBIL ************************************************************************************/

  //INDEX TRANSAKSI PROSES ***********************************************************************************************/
  public function proses()
  {
    $resi = $this->input->post('resi');
    $list_kota_asal   = $this->kota_model->get_allkota();
    $list_kota_tujuan = $this->kota_model->get_allkota();

    // Pencarian
    $kota_asal    = $this->input->post('kota_asal');
    $kota_tujuan  = $this->input->post('kota_tujuan');

    $kota = $this->kota_model->get_allkota();
    $config['base_url']         = base_url('admin/transaksi/proses/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row_proses($resi, $kota_asal, $kota_tujuan));
    $config['per_page']         = 10;
    $config['uri_segment']      = 5;
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi_proses($limit, $start, $resi, $kota_asal, $kota_tujuan);
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'kota'                  => $kota,
      'list_kota_asal'        => $list_kota_asal,
      'list_kota_tujuan'      => $list_kota_tujuan,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/proses_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI PROSES *******************************************************************************************/

  //INDEX TRANSAKSI SELESAI ***********************************************************************************************/
  public function selesai()
  {
    $resi = $this->input->post('resi');
    $list_kota_asal   = $this->kota_model->get_allkota();
    $list_kota_tujuan = $this->kota_model->get_allkota();

    // Pencarian
    $kota_asal    = $this->input->post('kota_asal');
    $kota_tujuan  = $this->input->post('kota_tujuan');

    $main_agen = $this->user_model->get_allcounter();
    $config['base_url']         = base_url('admin/transaksi/selesai/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row_selesai($resi, $kota_asal, $kota_tujuan));
    $config['per_page']         = 10;
    $config['uri_segment']      = 5;
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi_selesai($limit, $start, $resi, $kota_asal, $kota_tujuan);
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'main_agen'             => $main_agen,
      'list_kota_asal'        => $list_kota_asal,
      'list_kota_tujuan'      => $list_kota_tujuan,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/selesai_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI SELESAI *******************************************************************************************/

  //INDEX TRANSAKSI BATAL ***********************************************************************************************/
  public function batal()
  {
    $resi = $this->input->post('resi');
    $list_kota_asal   = $this->kota_model->get_allkota();
    $list_kota_tujuan = $this->kota_model->get_allkota();

    // Pencarian
    $kota_asal    = $this->input->post('kota_asal');
    $kota_tujuan  = $this->input->post('kota_tujuan');

    $main_agen = $this->user_model->get_allcounter();
    $config['base_url']         = base_url('admin/transaksi/batal/index/');
    $config['total_rows']       = count($this->transaksi_model->total_row_batal($resi, $kota_asal, $kota_tujuan));
    $config['per_page']         = 10;
    $config['uri_segment']      = 5;
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    $this->pagination->initialize($config);
    $transaksi = $this->transaksi_model->get_transaksi_batal($limit, $start, $resi, $kota_asal, $kota_tujuan);
    $data = [
      'title'                 => 'Data Transaksi',
      'transaksi'             => $transaksi,
      'main_agen'             => $main_agen,
      'list_kota_asal'        => $list_kota_asal,
      'list_kota_tujuan'      => $list_kota_tujuan,
      'pagination'            => $this->pagination->create_links(),
      'content'               => 'admin/transaksi/batal_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //END INDEX TRANSAKSI BATAL *******************************************************************************************/

  public function cari($rowno = 0)
  {
    $main_agen = $this->user_model->get_allcounter();
    // Search text
    $search_text = "";
    if ($this->input->post('submit') != NULL) {
      $search_text = $this->input->post('search');
      $this->session->set_userdata(array("search" => $search_text));
    } else {
      if ($this->session->userdata('search') != NULL) {
        $search_text = $this->session->userdata('search');
      }
    }
    // Row per page
    $rowperpage = 10;
    // Row position
    if ($rowno != 0) {
      $rowno = ($rowno - 1) * $rowperpage;
    }

    // All records count
    $allcount = $this->transaksi_model->getrecordCount_admin($search_text);

    // Get records
    $result = $this->transaksi_model->getData_admin($rowno, $rowperpage, $search_text);

    // Pagination Configuration
    $config['base_url'] = base_url() . 'admin/transaksi/cari';
    $config['use_page_numbers'] = TRUE;
    $config['total_rows'] = $allcount;
    $config['per_page'] = $rowperpage;

    //Membuat Style pagination untuk BootStrap v4
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';

    // Initialize
    $this->pagination->initialize($config);

    // $data['pagination'] = $this->pagination->create_links();
    // $data['result'] = $users_record;
    // $data['row'] = $rowno;
    // $data['search'] = $search_text;
    // var_dump($result);
    // die;

    $data = [
      'title'             => 'Transaksi',
      'deskripsi'         => 'Pencarian',
      'keywords'          => 'Pencarian',
      'pagination'        => $this->pagination->create_links(),
      'transaksi'         => $result,
      'row'               => $rowno,
      'search'            => $search_text,
      'main_agen'         => $main_agen,
      'content'           => 'admin/transaksi/cari_transaksi'

    ];
    // Load view
    $this->load->view('admin/layout/wrapp', $data);
  }


  public function create()
  {
    $provinsi       = $this->main_model->getProvinsi();
    //Validasi
    $this->form_validation->set_rules(
      'user_id',
      'User ID',
      'required',
      array(
        'required'                        => '%s Harus Diisi'
      )
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                           => 'Transaksi',
        'provinsi'                        => $provinsi,
        'content'                         => 'admin/transaksi/create_transaksi'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {
      $data  = [
        'user_id'                         => $this->input->post('user_id'),
        'provinsi_id'                    => $this->input->post('provinsi_id'),
        'kota_id'                       => $this->input->post('kota_id'),
        'kecamatan_id'                  => $this->input->post('kecamatan_id'),
        'date_created'                    => date('Y-m-d H:i:s')
      ];
      $this->transaksi_model->create($data);
      $this->session->set_flashdata('message', 'Data telah ditambahkan');
      redirect(base_url('admin/dashboard'), 'refresh');
    }
  }
  public function detail($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $lacak = $this->lacak_model->get_detail_lacak($id);
    // var_dump($transaksi);
    // die;
    $data = [
      'title'                 => 'Detail Transaksi',
      'transaksi'             => $transaksi,
      'lacak'                 => $lacak,
      'content'               => 'admin/transaksi/detail'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // Lacak
  public function lacak($id)
  {
    $transaksi = $this->transaksi_model->detail($id);
    $lacak = $this->lacak_model->get_detail_lacak($id);
    // var_dump($transaksi);
    // die;
    $data = [
      'title'         => 'Pelacakan',
      'deskripsi'     => 'Halaman Pelacakan',
      'keywords'      => '',
      'transaksi'     => $transaksi,
      'lacak'         => $lacak,
      'content'       => 'admin/transaksi/lacak_transaksi'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //delete
  public function delete($id)
  {
    //Proteksi delete
    is_login();
    $transaksi = $this->transaksi_model->product_detail($id);
    //Hapus gambar
    if ($transaksi->product_img != "") {
      unlink('./assets/img/product/' . $transaksi->product_img);
      // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
    }
    //End Hapus Gambar
    $data = ['id'               => $transaksi->id];
    $this->transaksi_model->delete($data);
    $this->session->set_flashdata('message', 'Data telah di Hapus');
    redirect($_SERVER['HTTP_REFERER']);
  }


  // Cancel Transaksi
  public function cancel($id)
  {
    // $user = $this->session->userdata('id');
    $transaksi = $this->transaksi_model->detail($id);
    if ($transaksi->stage == 1) {
      //Proteksi delete
      is_login();
      $data = [
        'id'                        => $id,
        'stage'                     => 10,
      ];
      $this->transaksi_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable fade show" > Data Telah di Batalkan <button class="close" data-dismiss="alert" aria-label="Close">??</button></div>');
      redirect(base_url('admin/transaksi'), 'refresh');
    } else {
      redirect('admin/404');
    }
  }
}
