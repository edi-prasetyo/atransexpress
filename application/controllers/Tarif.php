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
        $this->load->model('destinasi_model');
        $this->load->model('tarif_model');
    }

    public function index()
    {
        $kota_asal = $this->kota_model->get_allkota();
        $kota_tujuan = $this->kota_model->get_allkota();
        $tarif = '';


        $this->form_validation->set_rules(
            'kota_asal',
            'Kota Asal',
            'required',
            [
                'required'      => 'Kota Asal',
            ]
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'             => 'Cek Resi',
                'deskripsi'         => 'Cek Resi Pengiriman',
                'keywords'          => 'Resi',
                'tarif'             => $tarif,
                'kota_asal'         => $kota_asal,
                'kota_tujuan'       => $kota_tujuan,
                'content'           => 'front/tarif/index'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            $post_kota_asal                          = $this->input->post('kota_asal');
            $post_kota_tujuan                        = $this->input->post('kota_tujuan');
            $berat                                  = $this->input->post('berat');
            //Validasi Berhasil
            $destinasi = $this->destinasi_model->search_destinasi($post_kota_asal, $post_kota_tujuan);

            $destinasi_id = $destinasi->id;

            $tarif = $this->tarif_model->get_cek_tarif($destinasi_id);

            if (empty($tarif)) {
                $this->session->set_flashdata('empty_tarif', '<div class="alert alert-danger">Tarif Untuk Kota Ini Tidak tersedia</div> ');
                redirect('tarif');
            } else {

                $data = array(
                    'title'            => 'Detail Pelacakan',
                    'deskripsi'        => 'Lacak Paket',
                    'keywords'         => 'Paket Express',
                    'tarif'            => $tarif,
                    'berat'            => $berat,
                    'destinasi'        => $destinasi,
                    'kota_asal'         => $kota_asal,
                    'kota_tujuan'       => $kota_tujuan,
                    'content'          => 'front/tarif/index'
                );
                $this->load->view('front/layout/wrapp', $data, FALSE);
            }
        }
        $data = [
            'title'             => 'Cek Resi',
            'deskripsi'         => 'Cek Resi Pengiriman',
            'keywords'          => 'Resi',
            'tarif'             => $tarif,
            'kota_asal'         => $kota_asal,
            'kota_tujuan'       => $kota_tujuan,
            'content'           => 'front/tarif/index'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function detail()
    {

        $kota_asal = $this->kota_model->get_allkota();
        $kota_tujuan = $this->kota_model->get_allkota();

        $kota_asal                          = $this->input->post('kota_asal');
        $kota_tujuan                        = $this->input->post('kota_tujuan');
        $berat                              = $this->input->post('berat');
        // var_dump($lacak);
        // die;
        // $destinasi = $this->db->get_where('destinasi', ['kota_asal' => $kota_asal, 'kota_tujuan' => $kota_tujuan])->row_array();
        $destinasi = $this->destinasi_model->search_destinasi($kota_asal, $kota_tujuan);


        $destinasi_id = $destinasi->id;
        $tarif = $this->tarif_model->get_cek_tarif($destinasi_id);


        if (empty($tarif)) {
            $this->session->set_flashdata('empty_tarif', '<div class="alert alert-danger">Tarif Untuk Kota Ini Tidak tersedia</div> ');
            redirect('tarif');
        } else {

            $data = array(
                'title'            => 'Detail Pelacakan',
                'deskripsi'        => 'Lacak Paket',
                'keywords'         => 'Paket Express',
                'tarif'            => $tarif,
                'berat'            => $berat,
                'kota_asal'         => $kota_asal,
                'kota_tujuan'       => $kota_tujuan,
                'content'          => 'front/tarif/detail'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        }
    }
}
