<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saldo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('saldo_model');
        $this->load->model('bank_model');
    }
    public function index()
    {
        $user_id    = $this->session->userdata('id');
        $saldo = $this->saldo_model->get_my_saldo($user_id);
        $data = [
            'title'                 => 'Laporan Saldo Counter',
            'saldo'                 => $saldo,
            'content'               => 'counter/saldo/index'
        ];
        $this->load->view('counter/layout/wrapp', $data, FALSE);
    }
}
