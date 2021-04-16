<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('string');
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
        $transaksi  = $this->transaksi_model->get_transaksi_kurir($user_id);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'         => 'Dashboard',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'content'       => 'kurir/transaksi/index'
        );
        $this->load->view('kurir/layout/wrapp', $data, FALSE);
    }

    // Ambil Paket Dari Agen
    public function ambil($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);
        $nomor_resi = $transaksi->nomor_resi;

        $status = 'Paket sedang dikirim oleh Kurir ';
        $provinsi_id = $user->provinsi_id;

        $data  = [
            'id'                                => $id,
            'status'                            => $status,
            'user_stage'                        => $this->session->userdata('id'),
            'kurir_id'                          => $this->session->userdata('id'),
            'stage'                             => 8,
            'date_updated'                      => date('Y-m-d H:i:s')
        ];
        $this->transaksi_model->update($data);
        //Update Status Lacak
        $this->update_lacak($id, $status, $provinsi_id, $user, $nomor_resi);
        $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
        redirect(base_url('kurir/transaksi'), 'refresh');
    }

    //Kirim
    public function kirim()
    {
        $user_id = $this->session->userdata('id');
        // var_dump($user_id);
        // die;
        $transaksi  = $this->transaksi_model->get_transaksi_kirim($user_id);
        // End Listing Berita dengan paginasi
        $data = array(
            'title'         => 'Kirim Paket',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'content'       => 'kurir/transaksi/kirim'
        );
        $this->load->view('kurir/layout/wrapp', $data, FALSE);
    }

    // Sampai Ke tujuan
    public function finish($id)
    {
        $transaksi  = $this->transaksi_model->detail($id);
        $nomor_resi = $transaksi->nomor_resi;

        $this->form_validation->set_rules(
            'penerima',
            'Nama Penerima',
            'required',
            [
                'required'                        => 'Nama Penerima harus di isi',
            ]
        );

        if ($this->form_validation->run()) {
            $config['upload_path']              = './assets/img/transaksi/';
            $config['allowed_types']            = 'gif|jpg|png|jpeg';
            $config['max_size']                 = 500000; //Dalam Kilobyte
            $config['max_width']                = 500000; //Lebar (pixel)
            $config['max_height']               = 500000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                //End Validasi
                $data = [
                    'title'                         => 'Data Penerima',
                    'transaksi'                     => $transaksi,
                    'error_upload'                  => $this->upload->display_errors(),
                    'content'                       => 'kurir/transaksi/finish'
                ];
                $this->load->view('kurir/layout/wrapp', $data, FALSE);
                //Masuk Database
            } else {
                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/transaksi/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/transaksi/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 200;
                $config['height']           = 200;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();


                $status = 'Paket Di terima Oleh ' . $this->input->post('penerima');
                $provinsi_id = $transaksi->provinsi_id;

                $user_id = $this->session->userdata('id');
                $user = $this->user_model->user_detail($user_id);

                $data  = [
                    'id'                            => $id,
                    'kurir'                         => $user->id,
                    'status'                        =>  $status,
                    'penerima'                      => $status,
                    'stage'                         => 9,
                    'foto'                          => $upload_data['uploads']['file_name'],
                    'date_updated'                  => date('Y-m-d H:i:s')
                ];
                $this->transaksi_model->update($data);
                $this->update_lacak($id, $status, $provinsi_id, $user, $nomor_resi);
                $this->session->set_flashdata('message', 'Paket Telah Selesai');
                redirect(base_url('kurir/transaksi/kirim'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                             => 'Data Penerima',
            'transaksi'                         => $transaksi,
            'content'                           => 'kurir/transaksi/finish'
        ];
        $this->load->view('kurir/layout/wrapp', $data, FALSE);
    }

    // Update Pelacakan
    public function update_lacak($id, $status, $provinsi_id, $user, $nomor_resi)
    {
        $data  = [
            'transaksi_id'                                  => $id,
            'user_id'                                       => $user->id,
            'provinsi_id'                                   => $provinsi_id,
            'lacak_desc'                                    =>  $status,
            'nomor_resi'                                    => $nomor_resi,
            'date_updated'                                  => date('Y-m-d H:i:s')
        ];
        $this->lacak_model->create($data);
    }

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
            'content'       => 'kurir/transaksi/lacak'
        ];
        $this->load->view('kurir/layout/wrapp', $data, FALSE);
    }
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('kurir/transaksi/riwayat/index/');
        $config['total_rows']       = count($this->transaksi_model->get_row_kurir($user_id));
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
        $transaksi = $this->transaksi_model->get_riwayat_kurir($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'kurir/transaksi/riwayat'
        ];
        $this->load->view('kurir/layout/wrapp', $data, FALSE);
    }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
