<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    //main page - home page
    public function index()
    {
        $data = [
            'title'     => 'Page',
            'deskripsi' => 'Page',
            'keywords'  => 'Page',
            'content'   => 'front/page/index_page'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function cara_order()
    {
        $data = [
            'title'     => 'Cara Order',
            'deskripsi' => 'Cara Order',
            'keywords'  => 'Cara Order',
            'content'   => 'front/page/order_page'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function reseller()
    {
        $data = [
            'title'     => 'Reseller',
            'deskripsi' => 'Reseller',
            'keywords'  => 'Reseller',
            'content'   => 'front/page/reseller_page'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}