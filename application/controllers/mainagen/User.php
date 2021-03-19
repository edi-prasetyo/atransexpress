<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('provinsi_model');
        $this->load->model('main_model');
    }

    public function index()
    {
        $my_counter = $this->user_model->get_counterByAgen();
        $data = [
            'title'                 => 'Data Counter Saya',
            'my_counter'             => $my_counter,
            'content'               => 'mainagen/user/index_user'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
    // Detail Counter
    public function detail($id)
    {
        $user       = $this->session->userdata('id');
        $my_counter = $this->user_model->detail($id);
        // var_dump($user);
        // die;

        if ($my_counter->user_create == $user) {
            $data = [
                'title'                 => 'Detail Counter Saya',
                'my_counter'             => $my_counter,
                'content'               => 'mainagen/user/detail'
            ];
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('mainagen/404'));
        }
    }
}
