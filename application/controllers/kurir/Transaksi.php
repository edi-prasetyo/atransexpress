<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
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
        // $transaksi = $this->transaksi_model->detail($id);

        $status = 'Paket sedang dikirim oleh Kurir ';
        $provinsi_id = $user->provinsi_id;

        $data  = [
            'id'                                => $id,
            'status'                            => $status,
            'stage'                             => 8,
            'date_updated'                      => time()
        ];
        $this->transaksi_model->update($data);
        //Update Status Lacak
        $this->update_lacak($id, $status, $provinsi_id, $user);
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
                //Gambar Asli disimpan di folder assets/upload/image
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs
                $config['image_library']          = 'gd2';
                $config['source_image']           = './assets/img/transaksi/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']           = TRUE;
                $config['maintain_ratio']         = TRUE;
                $config['width']                  = 500;
                $config['height']                 = 500;
                $config['thumb_marker']           = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();


                $status = 'Paket Di terima Oleh' . $this->input->post('penerima');
                $provinsi_id = $transaksi->provinsi_id;
                $user = $this->session->userdata('id');

                $data  = [
                    'id'                            => $id,
                    'kurir'                         => $user,
                    'status'                        =>  $status,
                    'penerima'                      => $status,
                    'stage'                         => 9,
                    'foto'                          => $upload_data['uploads']['file_name'],
                    'date_updated'                  => time()
                ];
                $this->transaksi_model->update($data);
                $this->update_lacak($id, $status, $provinsi_id, $user);
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
    public function update_lacak($id, $status, $provinsi_id, $user)
    {
        $data  = [
            'transaksi_id'                                  => $id,
            'user_id'                                       => $user->id,
            'provinsi_id'                                   => $provinsi_id,
            'lacak_desc'                                    =>  $status,
            'date_updated'                                  => time()
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
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
