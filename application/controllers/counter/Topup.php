<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model('user_model');
        $this->load->model('nilaitopup_model');
        $this->load->model('topup_model');
        $this->load->model('bank_model');
    }
    public function index()
    {
        $code_topup = date('dmY') . strtoupper(random_string('alnum', 5));
        $nominal = $this->nilaitopup_model->get_nilai_topup();
        $bank = $this->bank_model->get_allbank();

        $user = $this->session->userdata('id');
        $my_topup = $this->topup_model->get_my_topup($user);

        $this->form_validation->set_rules(
            'nominal',
            'Nominal',
            'required',
            array(
                'required'                        => 'Anda Harus Memilih %s Top Up',
            )
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/struk/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 500000000000; //Dalam Kilobyte
            $config['max_width']            = 500000000000; //Lebar (pixel)
            $config['max_height']           = 500000000000; //tinggi (pixel)
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto_struk')) {

                $data = [
                    'title'                 => 'Top Up saldo Deposit',
                    'bank'                  => $bank,
                    'nominal'               => $nominal,
                    'my_topup'              => $my_topup,
                    'error_upload'          => $this->upload->display_errors(),
                    'content'               => 'counter/topup/index'
                ];
                $this->load->view('counter/layout/wrapp', $data, FALSE);
            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli dcontentmpan di folder assets/upload/Struk
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/struk/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/struk/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 300;
                $config['height']           = 300;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                $data  = [
                    'user_id'                   => $this->session->userdata('id'),
                    'code_topup'                => $code_topup,
                    'foto_struk'                => $upload_data['uploads']['file_name'],
                    'nominal'                   => $this->input->post('nominal'),
                    'keterangan'                => 'Top Up Counter',
                    'status_bayar'              => 'Pending',
                    'status_read'               => 0,
                    'date_created'              => date('Y-m-d H:i:s')
                ];
                $insert_id = $this->topup_model->create($data);
                $this->session->set_flashdata('message', 'Data telah ditambahkan');
                redirect(base_url('counter/topup/success/' . $insert_id), 'refresh');
            }
        }
        $data = [
            'title'                 => 'Top Up saldo Deposit',
            'bank'                  => $bank,
            'nominal'               => $nominal,
            'my_topup'              => $my_topup,
            'error_upload'          => $this->upload->display_errors(),
            'content'               => 'counter/topup/index'
        ];
        $this->load->view('counter/layout/wrapp', $data, FALSE);
    }
    public function success($insert_id)
    {
        $user = $this->session->userdata('id');

        $bank                               = $this->bank_model->get_allbank();
        $last_topup                         = $this->topup_model->last_topup($insert_id, $user);

        if ($last_topup->user_id == $user) {

            $data = [
                'title'                           => 'Success',
                'last_topup'                      => $last_topup,
                'bank'                            => $bank,
                'content'                         => 'counter/topup/success'
            ];
            $this->load->view('counter/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('counter/404'), 'refresh');
        }
    }

    // Detail Top Up
    public function detail($id)
    {
        $user_id    = $this->session->userdata('id');
        $topup      = $this->topup_model->detail_topup_konfirmasi($id);

        if ($topup->user_id == $user_id) {
            $data = [
                'title'     => 'Detail Top Up',
                'topup'     => $topup,
                'content'   => 'counter/topup/detail'
            ];
            $this->load->view('counter/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('counter/404'), 'refresh');
        }
    }

    // Konfirmasi Order
    public function konfirmasi($id)
    {
        $user_id = $this->session->userdata('id');
        $bank = $this->bank_model->get_allbank();
        $topup = $this->topup_model->detail_topup_konfirmasi($id);
        // var_dump($topup);
        // die;

        if ($topup->user_id == $user_id) {

            $config['upload_path']          = './assets/img/struk/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 500000000000; //Dalam Kilobyte
            $config['max_width']            = 500000000000; //Lebar (pixel)
            $config['max_height']           = 500000000000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_struk')) {

                $data = [
                    'title' => 'Konfirmasi',
                    'topup' => $topup,
                    'bank'  => $bank,
                    'content'   => 'counter/topup/konfirmasi'
                ];
                $this->load->view('counter/layout/wrapp', $data, FALSE);
            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli dcontentmpan di folder assets/upload/Struk
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/struk/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/struk/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/struk/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 300;
                $config['height']           = 300;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                $data  = array(
                    'id'                    => $id,
                    'foto_struk'            => $upload_data['uploads']['file_name'],
                    'status_bayar'          => 'Process',
                    'date_updated'          => date('Y-m-d H:i:s')
                );
                $this->topup_model->update($data);
                $this->session->set_flashdata('sukses', 'Terima Kasih Atas konfirmasi anda,  Top Up akan segera kami proses');
                redirect(base_url('counter/topup/berhasil'), 'refresh');
            }
        } else {
            redirect(base_url('counter/404'), 'refresh');
        }
    }
    // Top Up Berhasil
    public function berhasil()
    {
        $data = [
            'title'     => 'Konfirmai Berhasil',
            'content'   => 'counter/topup/berhasil'
        ];
        $this->load->view('counter/layout/wrapp', $data, FALSE);
    }
    // Batalkan Order
    public function batal($id)
    {
        $user                           = $this->session->userdata('id');
        $topup                          = $this->topup_model->detail_topup($id);

        if ($topup->user_id == $user) {
            $data  = array(
                'id'                    => $id,
                'status_bayar'          => 'Decline',
                'date_updated'          => date('Y-m-d H:i:s')
            );
            $this->topup_model->update($data);
            $this->session->set_flashdata('sukses', 'Transaksi Telah di batalkan');
            redirect(base_url('counter/topup'), 'refresh');
        } else {
            redirect(base_url('counter/404'), 'refresh');
        }
    }
}
