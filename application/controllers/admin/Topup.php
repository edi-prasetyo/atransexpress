<?php
defined('BASEPATH') or exit('No direct script access allowed');

class topup extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('topup_model');
        $this->load->model('user_model');
        $this->load->model('saldo_model');
    }
    //listing data topup
    public function index()
    {

        $config['base_url']         = base_url('admin/topup/index/');
        $config['total_rows']       = count($this->topup_model->total_row());
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
        $topup = $this->topup_model->get_topup($limit, $start);
        $data = [
            'title'                 => 'Data Topup',
            'topup'                 => $topup,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/topup/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }



    public function detail($id)
    {
        $topup = $this->topup_model->detail_topup($id);
        // var_dump($topup);
        // die;
        $data = [
            'title'                 => 'Detail Topup',
            'topup'             => $topup,
            'content'               => 'admin/topup/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Aprove
    public function aprove($id)
    {
        $topup = $this->topup_model->detail_topup($id);
        $nominal = $topup->nominal;
        $counter_id = $topup->user_id;

        $counter_detail = $this->user_model->detail($counter_id);
        $deposit_counter = $counter_detail->deposit_counter;

        $tambah_saldo = $nominal + $deposit_counter;

        // var_dump($tambah_saldo);
        // die;

        $data = [
            'id'                => $counter_id,
            'deposit_counter'   => $tambah_saldo,

        ];
        $this->user_model->update($data);
        $this->update_topup($counter_id, $id);
        $this->create_saldo_topup($counter_id, $nominal, $tambah_saldo);
        $this->session->set_flashdata('message', 'Data telah di Update');
        redirect(base_url('admin/topup'), 'refresh');
    }
    // Create Saldo Topup
    public function create_saldo_topup($counter_id, $nominal, $tambah_saldo)
    {
        $data = [
            'user_id'               => $counter_id,
            'pemasukan'             => $nominal,
            'transaksi'             => 0,
            'asuransi'              => 0,
            'pengeluaran'           => 0,
            'total_saldo'           => $tambah_saldo,
            'user_type'             => 'Counter',
            'keterangan'            => 'Top Up Saldo',
            'date_created'          => date('Y-m-d H:i:s')

        ];
        $this->saldo_model->create($data);
    }
    // Update Top Up
    public function update_topup($counter_id, $id)
    {
        $data = [
            'id'                => $id,
            'user_id'            => $counter_id,
            'status_bayar'      => 'Success',
            'date_updated'      => date('Y-m-d H:i:s')
        ];
        $this->topup_model->update($data);
    }
    // Decline
    public function decline($id)
    {
    }
}
