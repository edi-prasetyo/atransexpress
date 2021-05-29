<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Withdraw extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('nilaitopup_model');
        $this->load->model('withdraw_model');
        $this->load->model('bank_model');
    }
    public function index()
    {
        $code_withdraw = date('dmY') . strtoupper(random_string('alnum', 5));

        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $nominal_withdraw = $user->saldo_mainagen;

        $my_withdraw = $this->withdraw_model->get_my_withdraw($user_id);

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array(
                'required'                        => 'Anda Harus Memilih %s Top Up',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                     => 'Tarik Saldo',
                'my_withdraw'               => $my_withdraw,
                'content'                   => 'mainagen/withdraw/index'
            ];
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {

            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'code_withdraw'             => $code_withdraw,
                'nominal_withdraw'          => $nominal_withdraw,
                'keterangan'                => $this->input->post('keterangan'),
                'status_withdraw'           => 'Pending',
                'status_read'               => 0,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $insert_id = $this->withdraw_model->create($data);
            // Update Data Saldo MainAgen
            $this->update_saldo_mainagen($nominal_withdraw, $user);
            $this->create_laporan($nominal_withdraw, $user);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('mainagen/withdraw/success/' . $insert_id), 'refresh');
        }
    }
    public function update_saldo_mainagen($nominal_withdraw, $user)
    {
        $user_id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($user_id);

        $sisa_saldo = $user->saldo_mainagen - $nominal_withdraw;

        $data = [
            'id'                        => $user_id,
            'saldo_mainagen'            => $sisa_saldo,
        ];
        $this->user_model->update($data);
    }
    public function create_laporan($nominal_withdraw, $user)
    {
        $user_id = $this->session->userdata('id');
        $data = [
            'user_id'       => $user_id,
            'pemasukan'     => 0,
            'transaksi'     => 0,
            'asuransi'      => 0,
            'pengeluaran'   => $nominal_withdraw,
            'total_saldo'   => 0,
            'keterangan'    => 'Tarik Saldo',
            'user_type'     => 'Main Agen',
            'date_created'  => date('Y-m-d H:i:s')
        ];
        $this->saldo_model->create($data);
    }
    public function success($insert_id)
    {
        $user = $this->session->userdata('id');

        $bank                               = $this->bank_model->get_allbank();
        $last_withdraw                      = $this->withdraw_model->last_withdraw($insert_id, $user);

        if ($last_withdraw->user_id == $user) {
            $data = [
                'title'                      => 'Withdraw',
                'last_withdraw'              => $last_withdraw,
                'bank'                       => $bank,
                'content'                    => 'mainagen/withdraw/success'
            ];
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('mainagen/404'), 'refresh');
        }
    }

    // Riwayat
    public function riwayat()
    {
        $user_id = $this->session->userdata('id');
        // $user = $this->user_model->user_detail($user_id);
        $my_withdraw = $this->withdraw_model->get_allmy_withdraw($user_id);
        $data = [
            'title'     => 'Riwayat Withdraw',
            'my_withdraw'  => $my_withdraw,
            'content'   => 'mainagen/withdraw/riwayat'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
}
