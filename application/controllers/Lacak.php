<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lacak extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lacak_model');
        $this->load->model('transaksi_model');
    }





    public function index()
    {
        $this->form_validation->set_rules(
            'nomor_resi',
            'Nomor Resi',
            'required',
            [
                'required'      => 'Kode Transaksi',
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Cek Resi',
                'deskripsi'     => 'Cek Resi Pengiriman',
                'keywords'      => 'Resi',
                'content'       => 'front/lacak/index'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            //Validasi Berhasil
            $this->detail();
        }
    }

    public function detail()
    {
        // $nomor_resi                 = $this->input->post('nomor_resi');
        $nomor_resi                 = $this->input->post('nomor_resi');
        $lacak                      = $this->lacak_model->cek_resi($nomor_resi);
        // var_dump($lacak);
        // die;
        $transaksi = $this->db->get_where('transaksi', ['nomor_resi' => $nomor_resi])->row_array();

        if (empty($transaksi)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Kode Transaksi Tidak ada</div> ');
            redirect('lacak');
        } else {

            $data = array(
                'title'            => 'Detail Pelacakan',
                'deskripsi'        => 'Lacak Paket',
                'keywords'         => 'Paket Express',
                'lacak'            => $lacak,
                'content'          => 'front/lacak/detail'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        }
    }































    public function detail_lacak($id)
    {

        // $post_lacak = $this->input->post('nomor_resi');
        // $transaksi = $this->transaksi_model->get_resi($post_lacak);
        // echo $transaksi->id;
        // die;

        // $id = 1;
        // $nomor_resi             = $this->input->post('nomor_resi');
        $lacak                  = $this->lacak_model->get_detail_lacak($id);
        // var_dump($lacak);
        // die;

        // $lacak = $this->db->get_where('lacak', ['nomor_resi' => $nomor_resi])->row_array();



        $data = array(
            'title'                     => 'Transaksi',
            'deskripsi'                 => 'Deskripsi',
            'keywords'                  => 'Transaksi Atrans Express',
            'lacak'                     => $lacak,
            'content'                   => 'front/lacak/detail_lacak'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
}


/* end of file transaksi.php */
/* Location /application/controller/admin/transaksi.php */
