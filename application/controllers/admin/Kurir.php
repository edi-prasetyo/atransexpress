<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('provinsi_model');
        $this->load->model('main_model');
    }
    public function index()
    {

        $config['base_url']         = base_url('admin/kurir/index/');
        $config['total_rows']       = count($this->user_model->total_row_allkurir());
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
        $main_agen = $this->user_model->get_allkurir($limit, $start);
        // var_dump($main_agen);
        // die;

        $data = [
            'title'                 => 'Data Kurir',
            'main_agen'             => $main_agen,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/kurir/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // Detail Main Agen
    public function detail($id)
    {
        $main_agen = $this->user_model->detail($id);
        $data = [
            'title'                 => 'Detail Kurir',
            'main_agen'             => $main_agen,
            'content'               => 'admin/kurir/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Activated
    public function activated($id)
    {
        $user_detail =  $this->user_model->detail($id);
        $counter_id = $user_detail->id;
        $user_code = str_pad($counter_id, 6, '0', STR_PAD_LEFT);
        is_login();
        $data = [
            'id'                    => $id,
            'user_code'             => $user_code,
            'is_active'             => 1,
            'is_locked'             => 1,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di Aktifkan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Banned Acount
    public function banned($id)
    {
        is_login();
        $data = [
            'id'                    => $id,
            'is_active'             => 0,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di banned');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
