<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'title'                 => '404',
            'content'               => 'mainagen/oops/index'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
}
