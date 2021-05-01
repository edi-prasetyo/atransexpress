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
        $this->load->model('user_model');
        $this->load->model('lacak_model');
    }
    //Index

    public function index()
    {

        // $main_agen = $this->user_model->get_agen();
        $user_id = $this->session->userdata('id');

        $config['base_url']         = base_url('kurirpusat/transaksi/index/');
        $config['total_rows']       = count($this->transaksi_model->total_row_kurirpusat($user_id));
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
        $transaksi = $this->transaksi_model->get_transaksi_kurirpusat($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            // 'main_agen'             => $main_agen,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'kurirpusat/transaksi/index'
        ];
        $this->load->view('kurirpusat/layout/wrapp', $data, FALSE);
    }

    // public function index($rowno = 0)
    // {
    //     $user_id = $this->session->userdata('id');
    //     $main_agen = $this->user_model->get_all_mainagen();
    //     // Search text
    //     $search_text = "";
    //     if ($this->input->post('submit') != NULL) {
    //         $search_text = $this->input->post('search');
    //         $this->session->set_userdata(array("search" => $search_text));
    //     } else {
    //         if ($this->session->userdata('search') != NULL) {
    //             $search_text = $this->session->userdata('search');
    //         }
    //     }
    //     // Row per page
    //     $rowperpage = 10;
    //     // Row position
    //     if ($rowno != 0) {
    //         $rowno = ($rowno - 1) * $rowperpage;
    //     }

    //     // All records count
    //     $allcount = $this->transaksi_model->getrecordCount($user_id, $search_text);

    //     // Get records
    //     $result = $this->transaksi_model->getData($user_id, $rowno, $rowperpage, $search_text);

    //     // Pagination Configuration
    //     $config['base_url'] = base_url() . 'kurirpusat/transaksi';
    //     $config['use_page_numbers'] = TRUE;
    //     $config['total_rows'] = $allcount;
    //     $config['per_page'] = $rowperpage;

    //     //Membuat Style pagination untuk BootStrap v4
    //     $config['first_link']       = 'First';
    //     $config['last_link']        = 'Last';
    //     $config['next_link']        = 'Next';
    //     $config['prev_link']        = 'Prev';
    //     $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    //     $config['full_tag_close']   = '</ul></nav></div>';
    //     $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close']    = '</span></li>';
    //     $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close']  = '</span>Next</li>';
    //     $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close']  = '</span></li>';

    //     // Initialize
    //     $this->pagination->initialize($config);

    //     // $data['pagination'] = $this->pagination->create_links();
    //     // $data['result'] = $users_record;
    //     // $data['row'] = $rowno;
    //     // $data['search'] = $search_text;
    //     // var_dump($result);
    //     // die;

    //     $data = [
    //         'title'             => 'Ambil Paket Dari',
    //         'deskripsi'         => 'Pencarian',
    //         'keywords'          => 'Pencarian',
    //         'pagination'        => $this->pagination->create_links(),
    //         'transaksi'         => $result,
    //         'row'               => $rowno,
    //         'search'            => $search_text,
    //         'main_agen'         => $main_agen,
    //         'content'           => 'kurirpusat/transaksi/index'

    //     ];
    //     // Load view
    //     $this->load->view('kurirpusat/layout/wrapp', $data);
    // }


    // Ambil Paket
    public function ambil($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);
        $nomor_resi = $transaksi->nomor_resi;

        $status = 'Paket Sedang di kirim ke  ' . $transaksi->kota_name;
        // var_dump($status);
        // die;
        $provinsi_id = $transaksi->provinsi_id;

        if ($transaksi->kurir_pusat == $user_id && $transaksi->stage == 3) {

            $data  = [
                'id'                                => $id,
                'kurirpusat_id'                     => $user_id,
                'kurir_pusat'                     => $user_id,
                'status'                            => $status,
                'user_stage'                            => $this->session->userdata('id'),
                'stage'                             => 4,
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
            $this->transaksi_model->update($data);
            //Update Status Lacak
            $this->update_lacak($id, $status, $provinsi_id, $user, $nomor_resi);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('kurirpusat/transaksi'), 'refresh');
        } else {
            redirect(base_url('kurirpusat/404'));
        }
    }

    // Data kirimaan ke Agen Lain
    // public function kirim($rowno = 0)
    // {
    //     $user_id = $this->session->userdata('id');
    //     $main_agen = $this->user_model->get_all_mainagen();
    //     // Search text
    //     $search_text = "";
    //     if ($this->input->post('submit') != NULL) {
    //         $search_text = $this->input->post('search');
    //         $this->session->set_userdata(array("search" => $search_text));
    //     } else {
    //         if ($this->session->userdata('search') != NULL) {
    //             $search_text = $this->session->userdata('search');
    //         }
    //     }

    //     // Row per page
    //     $rowperpage = 10;
    //     // Row position
    //     if ($rowno != 0) {
    //         $rowno = ($rowno - 1) * $rowperpage;
    //     }

    //     // All records count
    //     $allcount = $this->transaksi_model->getrecordCountkirim($user_id, $search_text);

    //     // Get records
    //     $result = $this->transaksi_model->getDatakirim($user_id, $rowno, $rowperpage, $search_text);

    //     // Pagination Configuration
    //     $config['base_url'] = base_url() . 'kurirpusat/transaksi/kirim';
    //     $config['use_page_numbers'] = TRUE;
    //     $config['total_rows'] = $allcount;
    //     $config['per_page'] = $rowperpage;

    //     //Membuat Style pagination untuk BootStrap v4
    //     $config['first_link']       = 'First';
    //     $config['last_link']        = 'Last';
    //     $config['next_link']        = 'Next';
    //     $config['prev_link']        = 'Prev';
    //     $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    //     $config['full_tag_close']   = '</ul></nav></div>';
    //     $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    //     $config['num_tag_close']    = '</span></li>';
    //     $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    //     $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    //     $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    //     $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    //     $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    //     $config['prev_tagl_close']  = '</span>Next</li>';
    //     $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    //     $config['first_tagl_close'] = '</span></li>';
    //     $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    //     $config['last_tagl_close']  = '</span></li>';

    //     // Initialize
    //     $this->pagination->initialize($config);

    //     // $data['pagination'] = $this->pagination->create_links();
    //     // $data['result'] = $users_record;
    //     // $data['row'] = $rowno;
    //     // $data['search'] = $search_text;

    //     // var_dump($result);
    //     // die;

    //     $data = [
    //         'title'             => 'Kirim Paket Ke ',
    //         'deskripsi'         => 'Pencarian',
    //         'keywords'          => 'Pencarian',
    //         'pagination'        => $this->pagination->create_links(),
    //         'transaksi'         => $result,
    //         'row'               => $rowno,
    //         'search'            => $search_text,
    //         'main_agen'         => $main_agen,
    //         'content'           => 'kurirpusat/transaksi/kirim'

    //     ];
    //     // Load view
    //     $this->load->view('kurirpusat/layout/wrapp', $data);
    // }



    public function kirim()
    {
        $user_id = $this->session->userdata('id');
        $main_agen = $this->user_model->get_all_mainagen();

        $config['base_url']         = base_url('kurirpusat/transaksi/kirim/index');
        $config['total_rows']       = count($this->transaksi_model->total_row_kirim($user_id));
        $config['per_page']         = 10;
        $config['uri_segment']      = 5;

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
        $start                      = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $transaksi = $this->transaksi_model->get_kurirpusat_kirim($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'main_agen'             => $main_agen,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'kurirpusat/transaksi/kirim'
        ];
        $this->load->view('kurirpusat/layout/wrapp', $data, FALSE);
    }



    // Kirim Paket Ke Agen
    public function agen($id)
    {

        $transaksi  = $this->transaksi_model->transaksi_detail($id);
        $kota_id = $transaksi->kota_id;
        $main_agen_kota = $this->user_model->get_agen_kota($kota_id);
        // var_dump($main_agen_kota);
        // die;
        $user_id = $this->session->userdata('id');
        if ($transaksi->kurir_pusat == $user_id && $transaksi->stage == 4) {

            $this->form_validation->set_rules(
                'to_agen',
                'Nama Pengirim',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = [
                    'title'                           => 'Kirim Ke Agen',
                    'main_agen_kota'                  => $main_agen_kota,
                    'transaksi'                       => $transaksi,
                    'content'                         => 'kurirpusat/transaksi/kirim_agen'
                ];
                $this->load->view('kurirpusat/layout/wrapp', $data, FALSE);
            } else {

                $status = $this->input->post('status');
                $provinsi_id = $this->input->post('provinsi_id');

                $data  = [
                    'id'                                => $id,
                    'to_agen'                           => $this->input->post('to_agen'),
                    'status'                            => $status,
                    'provinsi_id'                       => $provinsi_id,
                    'mainagen_to_id'                       => $this->input->post('to_agen'),
                    'stage'                             => 5,
                    // 'status'                            => $status,
                    'date_updated'                      => date('Y-m-d H:i:s')
                ];
                $this->transaksi_model->update($data);
                //Update Status Lacak
                $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
                redirect(base_url('kurirpusat/transaksi/kirim'), 'refresh');
            }
        } else {
            redirect(base_url('kurirpusat/404'));
        }
    }

    public function update_lacak($id, $status, $provinsi_id, $user, $nomor_resi)
    {
        $data  = [
            'transaksi_id'                                  => $id,
            'user_id'                                       => $user->id,
            'provinsi_id'                                   => $provinsi_id,
            'lacak_desc'                                    => $status,
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
        $user_id = $this->session->userdata('id');
        if ($transaksi->kurirpusat_id == $user_id) {
            $data = [
                'title'         => 'Pelacakan',
                'deskripsi'     => 'Halaman Pelacakan',
                'keywords'      => '',
                'transaksi'     => $transaksi,
                'lacak'         => $lacak,
                'content'       => 'kurirpusat/transaksi/lacak'
            ];
            $this->load->view('kurirpusat/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('kurirpusat/404'));
        }
    }


    // Fungsi Pencarian
    public function search($rowno = 0)
    {
        $main_agen = $this->user_model->get_agen();
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
        $allcount = $this->transaksi_model->getrecordCount($search_text);

        // Get records
        $result = $this->transaksi_model->getData($rowno, $rowperpage, $search_text);

        // Pagination Configuration
        $config['base_url'] = base_url() . 'kurirpusat/transaksi/search';
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
            'title'             => 'Pencarian ',
            'deskripsi'         => 'Pencarian',
            'keywords'          => 'Pencarian',
            'pagination'        => $this->pagination->create_links(),
            'transaksi'         => $result,
            'row'               => $rowno,
            'search'            => $search_text,
            'main_agen'         => $main_agen,
            'content'           => 'kurirpusat/transaksi/search_transaksi'

        ];
        // Load view
        $this->load->view('kurirpusat/layout/wrapp', $data);
    }

    // Riwayat Transaksi

    public function riwayat()
    {
        $user_id = $this->session->userdata('id');


        $config['base_url']         = base_url('kurirpusat/riwayat/index/');
        $config['total_rows']       = count($this->transaksi_model->get_row_kurirpusat($user_id));
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
        $transaksi = $this->transaksi_model->get_riwayat_kurirpusat($limit, $start, $user_id);
        $data = [
            'title'                 => 'Data Transaksi',
            'transaksi'             => $transaksi,
            'search'                => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'kurirpusat/transaksi/riwayat'
        ];
        $this->load->view('kurirpusat/layout/wrapp', $data, FALSE);
    }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
