<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('pagination');
        $this->load->model('meta_model');
        $this->load->model('provinsi_model');
        $this->load->model('main_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('transaksi_model');
        $this->load->model('lacak_model');
    }
    //Index
    public function index()
    {




        $user_id = $this->session->userdata('id');
        // var_dump($user_id);
        // die;
        $transaksi  = $this->transaksi_model->get_transaksi_counter($user_id);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'         => 'Data Paket',
            'deskripsi'     => 'Halaman Paket',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'content'       => 'counter/transaksi/index'
        );
        $this->load->view('counter/layout/wrapp', $data, FALSE);
    }

    //Create
    public function create()
    {

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);

        $parent_counter = $user->id_agen;
        $get_mainagen_name = $this->user_model->get_mainagen_name($parent_counter);
        // $get_mainagen_city = $this->user_model->get_mainagen_city($parent_counter);

        // var_dump($get_mainagen_name->user_phone);
        // die;


        // var_dump($get_mainagen_name->name);
        // die;

        $provinsi       = $this->main_model->getProvinsi();
        $product        = $this->product_model->get_product();
        $category       = $this->category_model->get_category();


        $this->form_validation->set_rules(
            'provinsi_id',
            'Provinsi Tujuan',
            'required',
            array(
                'required'                        => 'Pilih %s'
            )
        );
        $this->form_validation->set_rules(
            'kota_id',
            'Kota Tujuan',
            'required',
            array(
                'required'                        => 'Pilih %s'
            )
        );
        $this->form_validation->set_rules(
            'category_id',
            'Kategori Barang',
            'required',
            array(
                'required'                        => 'Pilih %s'
            )
        );
        $this->form_validation->set_rules(
            'product_id',
            'Paket',
            'required',
            array(
                'required'                        => 'Pilih %s'
            )
        );
        $this->form_validation->set_rules(
            'nama_pengirim',
            'Nama Pengirim',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'telp_pengirim',
            'Telp Pengirim',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'alamat_pengirim',
            'Alamat Pengirim',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'kodepos_pengirim',
            'Kode Pos Pengirim',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'nama_penerima',
            'Nama Penerima',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'telp_penerima',
            'Telp Penerima',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'alamat_penerima',
            'Alamat Penerima',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'kodepos_penerima',
            'Kode Pos Penerima',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'nama_barang',
            'Nama Barang',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'berat',
            'Berat Paket',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        $this->form_validation->set_rules(
            'harga',
            'Harga Paket',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Buat Transaksi',
                'provinsi'                        => $provinsi,
                'product'                         => $product,
                'category'                        => $category,
                'user'                              => $user,
                'content'                         => 'counter/transaksi/create'
            ];
            $this->load->view('counter/layout/wrapp', $data, FALSE);
        } else {

            $nomor_resi = random_string('numeric', 8);


            // $this->load->library('zend');
            // $this->zend->load('Zend/Barcode');

            // $barcodeOptions = array('text' => $nomor_resi);
            // $rendererOptions = array();
            // $image_resource = Zend_Barcode::draw('code39', 'image', $barcodeOptions, $rendererOptions);
            // $image_name     = $nomor_resi . '.jpg';
            // $image_dir      = './assets/img/barcode/'; // penyimpanan file barcode
            // imagejpeg($image_resource, $image_dir . $image_name);

            $nilai_barang               = $this->input->post('nilai_barang');
            $fix_nilai_barang           = preg_replace('/\D/', '', $nilai_barang);

            $nilai_asuransi               = $this->input->post('nilai_asuransi');
            $fix_nilai_asuransi           = preg_replace('/\D/', '', $nilai_asuransi);

            $harga               = $this->input->post('harga');
            $fix_harga           = preg_replace('/\D/', '', $harga);

            $total_harga         = (int)$fix_harga + (int)$fix_nilai_asuransi;


            $data  = [
                'user_id'                           => $this->session->userdata('id'),
                'user_agen'                         => $parent_counter,
                'counter_id'                        => $this->session->userdata('id'),
                'category_id'                       => $this->input->post('category_id'),
                'product_id'                        => $this->input->post('product_id'),
                'provinsi_id'                       => $this->input->post('provinsi_id'),
                'kota_id'                           => $this->input->post('kota_id'),
                'kecamatan_id'                      => $this->input->post('kecamatan_id'),
                'nomor_resi'                        => $nomor_resi,
                'provinsi_from'                     => $this->input->post('provinsi_from'),
                'mainagen_name'                     => $get_mainagen_name->name . '-' . $get_mainagen_name->kota_name . '-' . $get_mainagen_name->user_phone,
                'kota_from'                         => $this->input->post('kota_from'),
                'nama_pengirim'                     => $this->input->post('nama_pengirim'),
                'telp_pengirim'                     => $this->input->post('telp_pengirim'),
                'alamat_pengirim'                   => $this->input->post('alamat_pengirim'),
                'email_pengirim'                    => $this->input->post('email_pengirim'),
                'kodepos_pengirim'                  => $this->input->post('kodepos_pengirim'),
                'nama_penerima'                     => $this->input->post('nama_penerima'),
                'telp_penerima'                     => $this->input->post('telp_penerima'),
                'alamat_penerima'                   => $this->input->post('alamat_penerima'),
                'email_penerima'                    => $this->input->post('email_penerima'),
                'kodepos_penerima'                  => $this->input->post('kodepos_penerima'),
                'nama_barang'                       => $this->input->post('nama_barang'),
                'berat'                             => $this->input->post('berat'),
                'koli'                              => $this->input->post('koli'),
                'panjang'                           => $this->input->post('panjang'),
                'lebar'                             => $this->input->post('lebar'),
                'tinggi'                            => $this->input->post('tinggi'),
                'harga'                             => $fix_harga,
                'asuransi'                          => $this->input->post('asuransi'),
                'nilai_asuransi'                    => $fix_nilai_asuransi,
                'total_harga'                       => $total_harga,
                'nilai_barang'                      => $fix_nilai_barang,
                'stage'                             => 1,
                'user_stage'                        => $this->session->userdata('id'),
                // 'barcode'                           => $image_name,
                'date_created'                      => date('Y-m-d H:i:s'),
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->transaksi_model->create($data);
            //Update Status Lacak
            $this->create_lacak($insert_id, $nomor_resi);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('counter/transaksi'), 'refresh');
        }
    }
    // Create Pelacakan
    public function create_lacak($insert_id, $nomor_resi)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        // $user = $this->session->userdata('id');
        // $last_transaksi = $this->lacak_model->last_lacak($insert_id);

        //Update Lacak
        $data  = array(
            'transaksi_id'      => $insert_id,
            'user_id'           => $user->id,
            'provinsi_id'       => $user->provinsi_id,
            'nomor_resi'        => $nomor_resi,
            'lacak_desc'        => 'Telah di Terima Counter',
            'date_created'      => date('Y-m-d H:i:s'),
            'date_updated'       => date('Y-m-d H:i:s')

        );
        $this->lacak_model->create($data);
    }
    // Halaman Pelacakan
    public function lacak($id)
    {
        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail($id);
        $lacak = $this->lacak_model->get_detail_lacak($id);
        // var_dump($transaksi);
        // die;

        if ($transaksi->user_id == $user_id) {

            $data = [
                'title'         => 'Pelacakan',
                'deskripsi'     => 'Halaman Pelacakan',
                'keywords'      => '',
                'transaksi'     => $transaksi,
                'lacak'         => $lacak,
                'content'       => 'counter/transaksi/lacak'
            ];
            $this->load->view('counter/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('counter/404'));
        }
    }

    // Riwayat Transaksi
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('counter/transaksi/riwayat/index');
        $config['total_rows']       = count($this->transaksi_model->get_row_counter($user_id));
        $config['per_page']         = 10;
        $config['uri_segment']      = 4;

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
        //Limit dan Start
        $limit                      = $config['per_page'];
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $transaksi = $this->transaksi_model->get_riwayat_counter($limit, $start, $user_id);
        $data = [
            'title'                 => 'Riwayat Transaksi',
            'transaksi'             => $transaksi,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'counter/transaksi/riwayat'
        ];
        $this->load->view('counter/layout/wrapp', $data, FALSE);
    }

    public function detail($id)
    {
        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail_counter($id, $user_id);

        $lacak = $this->lacak_model->get_detail_lacak($id);

        if ($transaksi->user_id == $user_id) {

            $data = [
                'title'                 => 'Detail Transaksi',
                'transaksi'             => $transaksi,
                'lacak'                 => $lacak,
                'content'               => 'counter/transaksi/detail'
            ];
            $this->load->view('counter/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('counter/404'));
        }
    }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
