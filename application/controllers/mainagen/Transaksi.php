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
        $main_agen = $this->user_model->get_agen();
        $user_id = $this->session->userdata('id');
        $transaksi  = $this->transaksi_model->get_transaksimycounter($user_id);

        $data = array(
            'title'         => 'Dashboard',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'main_agen'     => $main_agen,
            'content'       => 'mainagen/transaksi/index'
        );
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }


    public function from_agen()
    {
        $main_agen = $this->user_model->get_agen();
        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->get_transaksifromagen($user_id);
        $data = array(
            'title'         => 'Paket Dari Pusat',
            'deskripsi'     => 'Halaman Paket',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'main_agen'     => $main_agen,
            'content'       => 'mainagen/transaksi/from_agen'
        );
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
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
            'content'       => 'mainagen/transaksi/lacak'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
    // Ambil Paket
    public function ambil($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);

        $status = 'Paket telah di ambil Oleh Main Agen ' . $user->kota_name;
        $provinsi_id = $user->provinsi_id;

        $data  = [
            'id'                                => $id,
            'status'                            => $status,
            'stage'                             => 2,
            'date_updated'                      => time()
        ];
        $this->transaksi_model->update($data);
        //Update Status Lacak
        $this->update_lacak($id, $status, $provinsi_id, $user);
        $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
        redirect(base_url('mainagen/transaksi'), 'refresh');
    }

    // Terima Paket Dari Main Agen Lain
    public function terima($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);

        $status = 'Paket telah di terima Oleh Main Agen ' . $user->kota_name;
        $provinsi_id = $user->provinsi_id;

        $data  = [
            'id'                                => $id,
            'status'                            => $status,
            'stage'                             => 6,
            'date_updated'                      => time()
        ];
        $this->transaksi_model->update($data);
        //Update Status Lacak
        $this->update_lacak($id, $status, $provinsi_id, $user);
        $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
        redirect(base_url('mainagen/transaksi/from_agen'), 'refresh');
    }

    // Kirim Ke Kurir
    public function kirim()
    {

        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->kirim_ke_kurir($user_id);

        $data = array(
            'title'         => 'Kirim Paket',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,

            'content'       => 'mainagen/transaksi/kirim'
        );
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }

    public function kurir($id)
    {

        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail($id);
        $kota_id = $transaksi->kota_id;
        $kurir = $this->user_model->get_kurir($user_id, $kota_id);
        $kurir_agen = $this->user_model->get_kurir_agen($user_id);


        $this->form_validation->set_rules(
            'stage',
            'Stage',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'         => 'Kirim Paket',
                'deskripsi'     => 'Halaman Dashboard',
                'keywords'      => '',
                'transaksi'     => $transaksi,
                'kurir'         => $kurir,
                'kurir_agen'    => $kurir_agen,
                'content'       => 'mainagen/transaksi/kurir'
            );
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {
            $data  = [
                'id'                                => $id,
                'kurir_pusat'                             => $this->input->post('kurir_pusat'),
                'kurir'                             => $this->input->post('kurir'),
                'stage'                             => $this->input->post('stage'),
                'date_updated'                      => time()
            ];
            $this->transaksi_model->update($data);
            //Update Status Lacak
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('mainagen/transaksi/kirim'), 'refresh');
        }
    }

    // Ambil dari Kurir Pusat
    public function ambil_darikurir($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);

        $status = 'Paket telah di ambil Oleh Main Agen ' . $user->kota_name;
        $provinsi_id = $user->provinsi_id;

        $data  = [
            'id'                                => $id,
            'status'                            => $status,
            'stage'                             => 6,
            'date_updated'                      => time()
        ];
        $this->transaksi_model->update($data);
        //Update Status Lacak
        $this->update_lacak($id, $status, $provinsi_id, $user);
        $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
        redirect(base_url('mainagen/transaksi'), 'refresh');
    }

    // Pilih Kurir Pengiriman Ke Customer
    public function pilih_kurir($id)
    {
        $user_id = $this->session->userdata('id');
        // $user = $this->user_model->user_detail($user_id);
        $kurir_agen = $this->user_model->get_kurir_agen($user_id);
        $transaksi = $this->transaksi_model->detail($id);

        $this->form_validation->set_rules(
            'kurir',
            'Nama Kurir',
            'required',
            array(
                'required'                        => '%s Harus Diisi'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = array(
                'title'         => 'Kirim Paket',
                'deskripsi'     => 'Halaman Dashboard',
                'keywords'      => '',
                'transaksi'     => $transaksi,
                'kurir_agen'         => $kurir_agen,
                'content'       => 'mainagen/transaksi/kurir_agen'
            );
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {


            $data  = [
                'id'                                => $id,
                'kurir'                             => $this->input->post('kurir'),
                'stage'                             => 7,
                'date_updated'                      => time()
            ];
            $this->transaksi_model->update($data);
            //Update Status Lacak
            // $this->update_lacak($id, $status, $provinsi_id, $user);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('mainagen/transaksi/from_agen'), 'refresh');
        }
    }


    public function update_lacak($id, $status, $provinsi_id, $user)
    {
        $data  = [
            'transaksi_id'                                  => $id,
            'user_id'                                       => $user->id,
            'provinsi_id'                                   => $provinsi_id,
            'lacak_desc'                                    => $status,
            'date_updated'                                  => time()
        ];
        $this->lacak_model->create($data);
    }

    public function riwayat()
    {
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('mainagen/transaksi/riwayat/');
        $config['total_rows']       = count($this->transaksi_model->get_row_mainagen($user_id));
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
        $transaksi = $this->transaksi_model->get_riwayat_mainagen($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'mainagen/transaksi/riwayat'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
