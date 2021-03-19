
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->library('pagination');
    $this->load->model('meta_model');
    $this->load->model('products_model');
    $this->load->model('transaksi_model');
    $this->load->model('category_products_model');
    $this->load->helper('string'); //Memanggil Helper String
  }
  //main page - Berita
  public function index()
  {
    $meta                               = $this->meta_model->get_meta();
    $config['base_url']                 = base_url('admin/products/index/');
    $config['total_rows']               = count($this->products_model->total_row());
    $config['per_page']                 = 6;
    $config['uri_segment']              = 4;
    //Membuat Style pagination untuk BootStrap v4
    $config['first_link']               = 'First';
    $config['last_link']                = 'Last';
    $config['next_link']                = 'Next';
    $config['prev_link']                = 'Prev';
    $config['full_tag_open']            = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']           = '</ul></nav></div>';
    $config['num_tag_open']             = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']            = '</span></li>';
    $config['cur_tag_open']             = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']            = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']          = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']          = '</span>Next</li>';
    $config['first_tag_open']           = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close']         = '</span></li>';
    $config['last_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']          = '</span></li>';
    //Limit dan Start
    $limit                              = $config['per_page'];
    $start                              = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);
    $products = $this->products_model->get_products($limit, $start);
    $listcategory_products = $this->category_products_model->get_category_products();
    // End Listing Product dengan paginasi
    $data = array(
      'title'                           => 'Produk',
      'deskripsi'                       => 'Produk' . $meta->description,
      'keywords'                        => 'Produk' . $meta->keywords,
      'products'                        => $products,
      'listcategory_products'           => $listcategory_products,
      'pagination'                      => $this->pagination->create_links(),
      'content'                         => 'front/product/index_product'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // Produk - Category
  public function category_products($id)
  {
    $category_products                  = $this->category_products_model->read($id);
    $category_product_id                = $category_products->id;
    $listcategory_products              = $this->category_products_model->get_category_products();
    // Listing Berita Dengan Pagination
    $this->load->library('pagination');
    $config['base_url']                 = base_url('products/category_products/' . $id . '/index/');
    $config['total_rows']               = count($this->products_model->total_category_products($category_product_id));
    $config['per_page']                 = 6;
    $config['uri_segment']              = 5;
    //Membuat Style pagination untuk BootStrap v4
    $config['first_link']               = 'First';
    $config['last_link']                = 'Last';
    $config['next_link']                = 'Next';
    $config['prev_link']                = 'Prev';
    $config['full_tag_open']            = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']           = '</ul></nav></div>';
    $config['num_tag_open']             = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']            = '</span></li>';
    $config['cur_tag_open']             = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']            = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']          = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']          = '</span>Next</li>';
    $config['first_tag_open']           = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close']         = '</span></li>';
    $config['last_tag_open']            = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']          = '</span></li>';
    //Limit dan Start
    $limit                              = $config['per_page'];
    $start                              = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);
    $products                           = $this->products_model->product_category($category_product_id, $limit, $start);
    // End Listing Berita
    $data = array(
      'title'                           => 'Category : ' . $category_products->category_product_name,
      'deskripsi'                       => 'Kategori Produk - ',
      'keywords'                        => 'Kategori Produk - ',
      'pagination'                      => $this->pagination->create_links(),
      'products'                        => $products,
      'listcategory_products'           => $listcategory_products,
      'category_product_id'             => $category_product_id,
      'content'                         => 'front/product/index_product'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  //main page - detail Produk
  public function detail($product_slug = NULL)
  {
    if (!empty($product_slug)) {
      $product_slug;
    } else {
      redirect(base_url('products'));
    }
    $meta                               = $this->meta_model->get_meta();
    $products                           = $this->products_model->read($product_slug);
    $listcategory_products              = $this->category_products_model->get_category_products();
    $user_id                            = $products->user_id;
    $related_products                   = $this->products_model->related_product($user_id);
    $data = array(
      'title'                           => 'Produk',
      'deskripsi'                       => 'Produk - ' . $meta->description,
      'keywords'                        => 'Produk - ' . $meta->keywords,
      'products'                        => $products,
      'related_products'                => $related_products,
      'listcategory_products'           => $listcategory_products,
      'content'                         => 'front/product/detail_product'
    );
    $this->add_count($product_slug);
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  // This is the counter function..
  function add_count($product_slug)
  {
    // load cookie helper
    $this->load->helper('cookie');
    // this line will return the cookie which has slug name
    $check_visitor = $this->input->cookie(urldecode($product_slug), FALSE);
    // this line will return the visitor ip address
    $ip = $this->input->ip_address();
    // if the visitor visit this article for first time then //
    //set new cookie and update article_views column  ..
    //you might be notice we used slug for cookie name and ip
    //address for value to distinguish between articles  views
    if ($check_visitor == false) {
      $cookie = array(
        "name"                        => urldecode($product_slug),
        "value"                       => "$ip",
        "expire"                      =>  time() + 7200,
        "secure"                      => false
      );
      $this->input->set_cookie($cookie);
      $this->products_model->update_counter(urldecode($product_slug));
    }
  }
  //   Data Transaksi Order
  public function order($id)
  {
    $product                          = $this->products_model->product_detail($id);
    //Validasi

    $this->form_validation->set_rules(
      'user_title','Title','required',
      array(
        'required'                    => 'Anda harus memilih %s',
      )
    );

    $this->form_validation->set_rules(
      'name','Nama Lengkap','required',
      array(
        'required'                    => '%s Harus Diisi',
      )
    );
    $this->form_validation->set_rules(
      'user_email','Email','required',
      array(
        'required'                    => '%s Harus Diisi',
      )
    );
    $this->form_validation->set_rules(
      'user_phone','No. Handphone','required',
      array(
        'required'                    => '%s Harus Diisi',
      )
    );
    $this->form_validation->set_rules(
      'user_address','Alamat','required',
      array(
        'required'                    => '%s Harus Diisi',
      )
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                       => 'Order Emas',
        'deskripsi'                   => 'Beli Emas Online',
        'product'                     => $product,
        'content'                     => 'front/product/order_product'
      ];
      $this->load->view('front/layout/wrapp', $data, FALSE);
    }else{
      $data  = [
        'user_id'                     => $this->input->post('user_id'),
        'kode_transaksi'              => $this->input->post('kode_transaksi'),
        'product_name'                => $this->input->post('product_name'),
        'product_size'                => $this->input->post('product_size'),
        'product_price'               => $this->input->post('product_price'),
        'product_qty'                 => $this->input->post('product_qty'),
        'user_title'                 => $this->input->post('user_title'),
        'name'                   => $this->input->post('name'),
        'user_email'                  => $this->input->post('user_email'),
        'user_phone'                  => $this->input->post('user_phone'),
        'user_address'                => $this->input->post('user_address'),
        'type_transaksi'              => 'Jual',
        'status_read'                 => 0,
        'date_created'                => time()
      ];
      $insert_id = $this->transaksi_model->create($data);
      //Kirim Email
      // $this->_sendEmail($data, 'order');
      $this->session->set_flashdata('message', 'Pesanan Anda telah Terkirim');
      redirect(base_url('products/order_success/' .$insert_id), 'refresh');
    }
  }
  // private function _sendEmail($data, $type)
  // {
  // 	$config = [

  // 		'protocol' 		=> 'smtp',
  // 		'smtp_host' 	=> 'ssl://mail.sitemail.com',
  // 		'smtp_port' 	=> 465,
  // 		'smtp_user' 	=> 'mail@sitemail.com',
  // 		'smtp_pass' 	=> 'password',
  // 		'mailtype' 		=> 'html',
  // 		'charset' 		=> 'utf-8',
  // 	];
  // 	$this->load->library('email', $config);
  // 	$this->email->initialize($config);
  // 	$this->email->set_newline("\r\n");
  //     $this->email->from('mail@sitemail.com', 'Order - ' .$data['kode_transaksi'] );
  //     // $this->email->cc('');
  // 	$this->email->to('mail@sitemail.com');
  // 	if ($type == 'order') {
  // 		$this->email->subject('Order LM Mini Gold');
  // 		$this->email->message(
  //             ' Order Baru, Silahkan Cek Detail pesanan melalui Dashboard tokominigold '
  //         );
  // 	} elseif ($type == 'forgot') {
  // 		$this->email->subject('Reset Password');
  // 		$this->email->message('Silahkan Klik Link ini untuk Mereset Password');
  // 	}
  // 	if ($this->email->send()) {
  // 		return true;
  // 	} else {
  // 		echo $this->email->print_debugger();
  // 		die;
  // 	}
  // }
  public function order_success($insert_id)
  {
    $last_transaksi                     = $this->transaksi_model->last_transaksi($insert_id);
    $data = [
      'title'                           => 'Order Sukses',
      'deskripsi'                       => 'Beli Emas Online',
      'last_transaksi'                  => $last_transaksi,
      'content'                         => 'front/product/order_success'
    ];
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}

/* End of file Products.php */
/* Location: ./application/controllers/Products.php */
