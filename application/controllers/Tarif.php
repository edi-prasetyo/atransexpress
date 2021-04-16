<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('tarif_model');
        $this->load->model('kota_model');
    }

    public function index()
    {

        $data = [
            'title'         => 'Cek Resi',
            'deskripsi'     => 'Cek Resi Pengiriman',
            'keywords'      => 'Resi',
            'content'       => 'front/tarif/index'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    // public function detail()
    // {
    //     // $nomor_resi                 = $this->input->post('nomor_resi');
    //     $nomor_resi                 = $this->input->post('nomor_resi');
    //     $tarif                      = $this->tarif_model->cek_resi($nomor_resi);
    //     // var_dump($tarif);
    //     // die;
    //     $transaksi = $this->db->get_where('transaksi', ['nomor_resi' => $nomor_resi])->row_array();

    //     if (empty($transaksi)) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger">Kode Transaksi Tidak ada</div> ');
    //         redirect('tarif');
    //     } else {

    //         $data = array(
    //             'title'            => 'Detail Petarifan',
    //             'deskripsi'        => 'Tarif Paket',
    //             'keywords'         => 'Paket Express',
    //             'tarif'            => $tarif,
    //             'content'          => 'front/tarif/detail'
    //         );
    //         $this->load->view('front/layout/wrapp', $data, FALSE);
    //     }
    // }
}


/* end of file transaksi.php */
/* Location /application/controller/admin/transaksi.php */
