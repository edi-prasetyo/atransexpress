<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
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
        $search = $this->input->post('search');
        $my_kurir = $this->user_model->get_kurirByAgen($search);
        $data = [
            'title'                 => 'Data Kurir Saya',
            'my_kurir'              => $my_kurir,
            'content'               => 'mainagen/kurir/index'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
    // Create Kurir
    public function create()
    {
        $provinsi       = $this->main_model->getProvinsi();
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'required'     => 'Email Harus diisi',
                'valid_email'   => 'Email Harus Valid',
                'is_unique'    => 'Email Sudah ada, Gunakan Email lain'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches'     => 'Password tidak sama',
                'min_length'   => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run()) {
            $config['upload_path']              = './assets/img/avatars/';
            $config['allowed_types']            = 'gif|jpg|png|jpeg';
            $config['max_size']                 = 500000; //Dalam Kilobyte
            $config['max_width']                = 500000; //Lebar (pixel)
            $config['max_height']               = 500000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('user_image')) {
                //End Validasi
                $data = [
                    'title'         => 'Tambah Kurir',
                    'provinsi'      => $provinsi,
                    'content'       => 'mainagen/kurir/create'
                ];
                $this->load->view('mainagen/layout/wrapp', $data, FALSE);
                //Masuk Database
            } else {
                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli disimpan di folder assets/upload/image
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/img/avatars/thumbs
                $config['image_library']          = 'gd2';
                $config['source_image']           = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']           = TRUE;
                $config['maintain_ratio']         = TRUE;
                $config['width']                  = 500;
                $config['height']                 = 500;
                $config['thumb_marker']           = '';
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $email = $this->input->post('email', true);
                $data = [
                    'user_create'   => $this->session->userdata('id'),
                    'id_agen'   => $this->session->userdata('id'),
                    'user_title'    => $this->input->post('user_title'),
                    'provinsi_id'   => $this->input->post('provinsi_id'),
                    'kota_id'       => $this->input->post('kota_id'),
                    'name'          => htmlspecialchars($this->input->post('name', true)),
                    'email'         => htmlspecialchars($email),
                    'user_image'    => $upload_data['uploads']['file_name'],
                    'user_phone'    => $this->input->post('user_phone'),
                    'user_address'  => $this->input->post('user_address'),
                    'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id'       => 7,
                    'is_active'     => 0,
                    'is_locked'     => 0,
                    'date_created'  => date('Y-m-d H:i:s')
                ];
                $this->db->insert('user', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
                redirect('mainagen/kurir');
            }
        }
        $data = [
            'title'         => 'Tambah Kurir',
            'provinsi'      => $provinsi,
            'content'       => 'mainagen/kurir/create'
        ];
        $this->load->view('mainagen/layout/wrapp', $data, FALSE);
    }
    // Update Password
    public function update_password($id)
    {

        $user_id = $this->session->userdata('id');
        $user = $this->user_model->detail($id);


        if ($user->user_create == $user_id) {

            $this->form_validation->set_rules(
                'password1',
                'Password',
                'required|trim|min_length[3]|matches[password2]',
                [
                    'matches'     => 'Password tidak sama',
                    'min_length'   => 'Password Min 3 karakter'
                ]
            );
            $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

            if ($this->form_validation->run() == false) {
                $data = [
                    'title'         => 'Update Password',
                    'user'          => $user,
                    'content'       => 'mainagen/kurir/update_password'
                ];
                $this->load->view('mainagen/layout/wrapp', $data, FALSE);
            } else {
                $data = [
                    'id'                => $id,
                    'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                ];
                $this->user_model->update($data);
                $this->session->set_flashdata('message', 'Data Berhasil di Update');
                redirect('mainagen/kurir');
            }
        } else {
            redirect('mainagen/404');
        }
    }

    // Update Kurir
    public function update($id)
    {
        $user   = $this->session->userdata('id');
        $kurir      = $this->user_model->detail($id);
        //Validasi

        if ($kurir->id_agen == $user) {
            //Validasi
            $valid = $this->form_validation;

            $valid->set_rules(
                'name',
                'Nama',
                'required',
                array('required'      => '%s harus diisi')
            );

            if ($valid->run()) {
                //Kalau nggak Ganti gambar
                if (!empty($_FILES['user_image']['name'])) {

                    $config['upload_path']          = './assets/img/avatars/';
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['max_size']             = 5000000; //Dalam Kilobyte
                    $config['max_width']            = 5000000; //Lebar (pixel)
                    $config['max_height']           = 5000000; //tinggi (pixel)
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('user_image')) {

                        //End Validasi
                        $data = array(
                            'title'             => 'Update Kurir',
                            'kurir'              => $kurir,
                            'error_upload'      => $this->upload->display_errors(),
                            'content'           => 'mainagen/kurir/update'
                        );
                        $this->load->view('mainagen/layout/wrapp', $data, FALSE);

                        //Masuk Database

                    } else {

                        //Proses Manipulasi Gambar
                        $upload_data    = array('uploads'  => $this->upload->data());
                        //Gambar Asli disimpan di folder assets/upload/image
                        //lalu gambar Asli di copy untuk versi mini size ke folder assets/img/avatars/thumbs

                        $config['image_library']    = 'gd2';
                        $config['source_image']     = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
                        //Gambar Versi Kecil dipindahkan
                        // $config['new_image']        = './assets/img/avatars/thumbs/' . $upload_data['uploads']['file_name'];
                        $config['create_thumb']     = TRUE;
                        $config['maintain_ratio']   = TRUE;
                        $config['width']            = 200;
                        $config['height']           = 200;
                        $config['thumb_marker']     = '';

                        $this->load->library('image_lib', $config);

                        $this->image_lib->resize();



                        // Hapus Gambar Lama Jika Ada upload gambar baru
                        if ($kurir->user_image != "") {
                            unlink('./assets/img/avatars/' . $kurir->user_image);
                            // unlink('./assets/img/avatars/thumbs/' . $user->gambar);
                        }
                        //End Hapus Gambar

                        $data  = array(
                            'id'      => $id,
                            'name'      => $this->input->post('name'),
                            'user_address'      => $this->input->post('user_address'),
                            'user_phone'      => $this->input->post('user_phone'),
                            'user_image'         => $upload_data['uploads']['file_name'],
                            'date_updated'         => date('Y-m-d H:i:s')

                        );
                        $this->user_model->update($data);
                        $this->session->set_flashdata('sukses', 'Data telah Diedit');
                        redirect(base_url('mainagen/kurir'), 'refresh');
                    }
                } else {
                    //Update Berita Tanpa Ganti Gambar

                    // Hapus Gambar Lama Jika ada upload gambar baru
                    if ($kurir->user_image != "")
                        $data  = array(
                            'id'      => $id,
                            'name'      => $this->input->post('name'),
                            'user_address'      => $this->input->post('user_address'),
                            'user_phone'      => $this->input->post('user_phone'),
                            // 'user_image'         => $upload_data['uploads']['file_name'],
                            'date_updated'         => date('Y-m-d H:i:s')

                        );
                    $this->user_model->update($data);
                    $this->session->set_flashdata('sukses', 'Data telah Diedit');
                    redirect(base_url('mainagen/kurir'), 'refresh');
                }
            }
            //End Masuk Database
            $data = array(
                'title'             => 'Update Kurir',
                'kurir'              => $kurir,
                'content'           => 'mainagen/kurir/update'
            );
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('mainagen/404'));
        }
    }
    // Detail Kurir
    public function detail($id)
    {
        $user       = $this->session->userdata('id');
        $kurir      = $this->user_model->detail($id);
        // var_dump($user);
        // die;

        if ($kurir->id_agen == $user) {
            $data = [
                'title'                 => 'Detail Kurir Saya',
                'kurir'                 => $kurir,
                'content'               => 'mainagen/kurir/detail'
            ];
            $this->load->view('mainagen/layout/wrapp', $data, FALSE);
        } else {
            redirect(base_url('mainagen/404'));
        }
    }

    public function activated($id)
    {
        $user = $this->session->userdata('id');

        $kurir =  $this->user_model->detail($id);
        $kurir_id = $kurir->id;
        $user_code = str_pad($kurir_id, 6, '0', STR_PAD_LEFT);

        if ($kurir->id_agen == $user) {

            is_login();
            $data = [
                'id'                    => $id,
                'user_code'          => $user_code,
                'is_active'             => 1,
                'is_locked'             => 1,
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'User Telah di Aktifkan');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(base_url('404'));
        }
    }

    public function banned($id)
    {
        $user = $this->session->userdata('id');
        $kurir =  $this->user_model->detail($id);
        if ($kurir->id_agen == $user) {
            //Proteksi delete
            is_login();
            $data = [
                'id'                    => $id,
                'is_active'             => 0,
                'is_locked'             => 0,
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'User Telah di banned');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(base_url('404'));
        }
    }
}
