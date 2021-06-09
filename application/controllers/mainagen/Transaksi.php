<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('pagination');
        $this->load->model('meta_model');
        $this->load->model('provinsi_model');
        $this->load->model('main_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('transaksi_model');
        $this->load->model('lacak_model');
        $this->load->model('persentase_model');
        $this->load->model('user_model');
        $this->load->model('saldo_model');
    }
    //Index
    public function index()
    {
        $main_agen = $this->user_model->get_all_mainagen();
        $user_id = $this->session->userdata('id');
        $transaksi  = $this->transaksi_model->get_transaksimycounter($user_id);

        $data = array(
            'title'         => 'Ambil Paket',
            'deskripsi'     => 'Halaman Ambil Paket',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'main_agen'     => $main_agen,
            'content'       => 'mainagen/transaksi/index'
        );
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }

    // Ambil Paket dari Counter
    public function ambil($id)
    {

        $mainagen_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($mainagen_id);

        $transaksi = $this->transaksi_model->detail($id);
        $nomor_resi = $transaksi->nomor_resi;
        // Fungsi Untuk Pemotongan
        $harga = $transaksi->harga;
        $nilai_asuransi = $transaksi->nilai_asuransi;
        $counter_id = $transaksi->user_id;
        // End Fungsi Untuk Pemotongan

        $status = 'Paket telah di ambil Oleh Main Agen ' . $user->kota_name;
        $provinsi_id = $user->provinsi_id;

        if ($transaksi->user_agen == $mainagen_id && $transaksi->stage == 1) {

            $data  = [
                'id'                                => $id,
                'mainagen_id'                       => $this->session->userdata('id'),
                'status'                            => $status,
                'stage'                             => 2,
                'user_stage'                        => $this->session->userdata('id'),
                'status_transaksi'                  => 1,
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
            $this->transaksi_model->update($data);
            //Update Status Lacak
            $this->update_lacak($id, $status, $provinsi_id, $user, $nomor_resi);
            // Fungsi Pemotongan
            $this->potong_saldo_counter($harga, $nilai_asuransi, $counter_id, $nomor_resi);
            // End Fungsi Potongan
            $this->tambah_saldo_mainagen($harga, $user, $nomor_resi);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('mainagen/transaksi'), 'refresh');
        } else {
            redirect(base_url('mainagen/404'));
        }
    }

    // Potong Saldo Counter
    public function potong_saldo_counter($harga, $nilai_asuransi, $counter_id, $nomor_resi)
    {
        $persentase = $this->persentase_model->get_persentase();
        $pemotongan = $persentase->potong_saldo;
        // var_dump($pemotongan);
        // die;
        // $deposit_counter = $user_id->deposit_counter - $pemotongan;
        $counter = $this->user_model->detail_counter($counter_id);

        $fee_counter = ($pemotongan / 100) * $harga;
        $deposit_counter = $counter->deposit_counter - $fee_counter - $nilai_asuransi;

        $data = [
            'id'                => $counter_id,
            'deposit_counter'   => $deposit_counter,
        ];
        $this->user_model->update($data);
        // Create Riwayat Saldo
        $this->create_saldo_counter($counter_id, $fee_counter, $nomor_resi, $deposit_counter, $harga, $nilai_asuransi);
    }
    public function create_saldo_counter($counter_id, $fee_counter, $nomor_resi, $deposit_counter, $harga, $nilai_asuransi)
    {
        $pengeluaran = $fee_counter + $nilai_asuransi;

        $data = [
            'user_id'       => $counter_id,
            'pemasukan'     => 0,
            'pengeluaran'   => $fee_counter,
            'transaksi'     => $harga,
            'asuransi'      => $nilai_asuransi,
            'keterangan'    => $nomor_resi,
            'total_saldo'   => $deposit_counter,
            'user_type'     => $counter_id,
            'date_created'                      => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }
    // Tambah Saldo Mainagen
    public function tambah_saldo_mainagen($total_harga, $user, $nomor_resi)
    {
        $mainagen_id = $this->session->userdata('id');
        $persentase = $this->persentase_model->get_persentase();
        $fee_mainagen = $persentase->fee_from_counter;
        // var_dump($pemotongan);
        // die;
        // $deposit_counter = $user_id->deposit_counter - $pemotongan;

        $fee_mainagen = ($fee_mainagen / 100) * $total_harga;
        $saldo_mainagen = $user->saldo_mainagen + $fee_mainagen;

        $data = [
            'id'                => $mainagen_id,
            'saldo_mainagen'   => $saldo_mainagen,
        ];
        $this->user_model->update($data);
        $this->create_saldo_mainagen($fee_mainagen, $saldo_mainagen, $nomor_resi);
    }
    public function create_saldo_mainagen($fee_mainagen, $saldo_mainagen, $nomor_resi)
    {
        $user_id = $this->session->userdata('id');
        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => $fee_mainagen,
            'transaksi'     => 0,
            'asuransi'      => 0,
            'pengeluaran'   => 0,
            'total_saldo'   => $saldo_mainagen,
            'keterangan'    => $nomor_resi,
            'user_type'     => $user_id,
            'date_created'  => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }

    // Paket dari Agen Lain
    public function from_agen()
    {
        $resi = $this->input->post('resi');
        $main_agen = $this->user_model->get_all_mainagen();
        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->get_transaksifromagen($user_id, $resi);
        $data = array(
            'title'         => 'Paket Dari Pusat',
            'deskripsi'     => 'Halaman Paket',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            'main_agen'     => $main_agen,
            'content'       => 'mainagen/transaksi/from_agen'
        );
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }


    public function lacak($id)
    {

        $transaksi = $this->transaksi_model->detail($id);
        $lacak = $this->lacak_model->get_detail_lacak($id);
        // var_dump($transaksi);
        // die;

        $user_id = $this->session->userdata('id');
        if ($transaksi->mainagen_id == $user_id || $transaksi->mainagen_to_id == $user_id) {

            $data = [
                'title'         => 'Pelacakan',
                'deskripsi'     => 'Halaman Pelacakan',
                'keywords'      => '',
                'transaksi'     => $transaksi,
                'lacak'         => $lacak,
                'content'       => 'mainagen/transaksi/lacak'
            ];
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('mainagen/404'));
        }
    }

    // Terima Paket Dari Main Agen Lain
    public function terima($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);
        $nomor_resi = $transaksi->nomor_resi;

        // Fungsi Untuk Fee Main Agen Tujuan
        $total_harga = $transaksi->total_harga;
        // End Fungsi Untuk Fee Main Agen Tujuan

        $status = 'Paket telah di terima Oleh Main Agen ' . $user->kota_name;
        $provinsi_id = $user->provinsi_id;

        if ($transaksi->mainagen_to_id == $user_id && $transaksi->stage == 5) {

            $data  = [
                'id'                                => $id,
                'status'                            => $status,
                'user_stage'                        => $this->session->userdata('id'),
                'stage'                             => 6,
                'date_updated'                      => date('Y-m-d H:i:s')
            ];
            $this->transaksi_model->update($data);
            //Update Status Lacak
            $this->update_lacak($id, $status, $provinsi_id, $user, $nomor_resi);
            // Tambah Saldo Mainagen Tujuan
            $this->tambah_saldo_mainagen_tujuan($total_harga, $user);
            $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
            redirect(base_url('mainagen/transaksi/from_agen'), 'refresh');
        } else {
            redirect(base_url('mainagen/404'));
        }
    }
    // Fungsi Tambah Saldo Main Agen Tujuan
    public function tambah_saldo_mainagen_tujuan($total_harga, $user)
    {
        $mainagen_id = $this->session->userdata('id');
        $persentase = $this->persentase_model->get_persentase();
        $fee_mainagen = $persentase->fee_from_agen;
        // var_dump($pemotongan);
        // die;
        // $deposit_counter = $user_id->deposit_counter - $pemotongan;

        $fee_mainagen = ($fee_mainagen / 100) * $total_harga;
        $saldo_mainagen_tujuan = $user->saldo_mainagen + $fee_mainagen;

        $data = [
            'id'                => $mainagen_id,
            'saldo_mainagen'    => $saldo_mainagen_tujuan,
        ];
        $this->user_model->update($data);
    }

    // Kirim Ke Kurir
    public function kirim()
    {
        $user_id = $this->session->userdata('id');
        $resi = $this->input->post('resi');

        $transaksi = $this->transaksi_model->kirim_ke_kurir($user_id, $resi);
        // $kurirpusat = $this->transaksi_model->kirim_ke_kurirpusat($user_id);

        $data = array(
            'title'         => 'Kirim Paket',
            'deskripsi'     => 'Halaman Dashboard',
            'keywords'      => '',
            'transaksi'     => $transaksi,
            // 'kurirpusat'    => $kurirpusat,

            'content'       => 'mainagen/transaksi/kirim'
        );
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }

    public function kurir($id)
    {

        $user_id = $this->session->userdata('id');
        $transaksi = $this->transaksi_model->detail($id);
        $kota_id = $transaksi->kota_id;
        $kurir = $this->user_model->get_kurir($user_id, $kota_id);
        $kurir_agen = $this->user_model->get_kurir_agen($user_id);

        if ($transaksi->user_stage == $user_id) {

            $this->form_validation->set_rules(
                'stage',
                'Stage',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = array(
                    'title'         => 'Kirim Paket',
                    'deskripsi'     => 'Halaman Dashboard',
                    'keywords'      => '',
                    'transaksi'     => $transaksi,
                    'kurir'         => $kurir,
                    'kurir_agen'    => $kurir_agen,
                    'content'       => 'mainagen/transaksi/kurir'
                );
                $this->load->view('mainagen/layout/wrapp', $data, FALSE);
            } else {
                $data  = [
                    'id'                                => $id,
                    'kurir_pusat'                       => $this->input->post('kurir'),
                    'kurir'                             => $this->input->post('kurir'),
                    'kurir_stage'                       => $this->input->post('kurir'),
                    'stage'                             => $this->input->post('stage'),
                    'date_updated'                      => date('Y-m-d H:i:s')
                ];
                $this->transaksi_model->update($data);
                //Update Status Lacak
                $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
                redirect(base_url('mainagen/transaksi/kirim'), 'refresh');
            }
        } else {
            redirect(base_url('mainagen/404'));
        }
    }

    // Ambil dari Kurir Pusat
    public function ambil_darikurir($id)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);
        $transaksi = $this->transaksi_model->detail($id);
        $nomor_resi = $transaksi->nomor_resi;

        $status = 'Paket telah di ambil Oleh Main Agen ' . $user->kota_name;
        $provinsi_id = $user->provinsi_id;

        $data  = [
            'id'                                => $id,
            'status'                            => $status,
            'stage'                             => 6,
            'date_updated'                      => date('Y-m-d H:i:s')
        ];
        $this->transaksi_model->update($data);
        //Update Status Lacak
        $this->update_lacak($id, $status, $provinsi_id, $user, $nomor_resi);
        $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
        redirect(base_url('mainagen/transaksi'), 'refresh');
    }

    // Pilih Kurir Pengiriman Ke Customer
    public function pilih_kurir($id)
    {
        $user_id = $this->session->userdata('id');
        // $user = $this->user_model->user_detail($user_id);
        $kurir_agen = $this->user_model->get_kurir_agen($user_id);
        $transaksi = $this->transaksi_model->detail($id);

        if ($transaksi->mainagen_to_id == $user_id && $transaksi->stage == 6) {

            $this->form_validation->set_rules(
                'kurir',
                'Nama Kurir',
                'required',
                array(
                    'required'                        => '%s Harus Diisi'
                )
            );
            if ($this->form_validation->run() === FALSE) {
                $data = array(
                    'title'         => 'Kirim Paket',
                    'deskripsi'     => 'Halaman Dashboard',
                    'keywords'      => '',
                    'transaksi'     => $transaksi,
                    'kurir_agen'         => $kurir_agen,
                    'content'       => 'mainagen/transaksi/kurir_agen'
                );
                $this->load->view('mainagen/layout/wrapp', $data, FALSE);
            } else {


                $data  = [
                    'id'                                => $id,
                    'kurir'                             => $this->input->post('kurir'),
                    'kurir_id'                          => $this->input->post('kurir'),
                    'kurir_stage'                       => $this->input->post('kurir'),
                    'stage'                             => 7,
                    'date_updated'                      => date('Y-m-d H:i:s')
                ];
                $this->transaksi_model->update($data);
                //Update Status Lacak
                // $this->update_lacak($id, $status, $provinsi_id, $user);
                $this->session->set_flashdata('message', 'Data  telah ditambahkan ');
                redirect(base_url('mainagen/transaksi/from_agen'), 'refresh');
            }
        } else {
            redirect(base_url('mainagen/404'));
        }
    }


    public function update_lacak($id, $status, $provinsi_id, $user, $nomor_resi)
    {
        $data  = [
            'transaksi_id'                                  => $id,
            'user_id'                                       => $user->id,
            'provinsi_id'                                   => $provinsi_id,
            'nomor_resi'                                    => $nomor_resi,
            'lacak_desc'                                    => $status,
            'date_updated'                                  => date('Y-m-d H:i:s')
        ];
        $this->lacak_model->create($data);
    }

    public function riwayat()
    {
        $user_id = $this->session->userdata('id');
        $search = $this->input->post('search');

        $config['base_url']         = base_url('mainagen/transaksi/riwayat/index/');
        $config['total_rows']       = count($this->transaksi_model->get_row_mainagen($user_id, $search));
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
        $transaksi = $this->transaksi_model->get_riwayat_mainagen($limit, $start, $user_id, $search);
        $data = [
            'title'                 => 'Riwayat Transaksi',
            'transaksi'             => $transaksi,
            'search'     => '',
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'mainagen/transaksi/riwayat'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
    // Detail
    public function detail($id)
    {
        $user_id    = $this->session->userdata('id');
        $transaksi  = $this->transaksi_model->detail_riwayat_mainagen($id, $user_id);
        $lacak = $this->lacak_model->get_detail_lacak($id);

        $data = [
            'title'         => 'Detail Transaksi',
            'transaksi'     => $transaksi,
            'lacak'         => $lacak,
            'content'       => 'mainagen/transaksi/detail'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
}

/* End of file About.php */
/* Location: ./application/controllers/About.php */
