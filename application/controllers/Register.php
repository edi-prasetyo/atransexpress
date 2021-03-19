<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('id')) {
            redirect('home');
        }


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
                'required'         => 'Email Harus diisi',
                'valid_email'     => 'Email Harus Valid',
                'is_unique'        => 'Email Sudah ada, Gunakan Email lain'
            ]
        );
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches'         => 'Password tidak sama',
                'min_length'     => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title'            => 'Register',
                'content'           => 'front/register/index'
            ];
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {

            // Foto
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
                $dataInfo[] = $this->upload->data();
            }



            $email = $this->input->post('email', true);
            $data = [
                'user_title'        => $this->input->post('user_title'),
                'name'              => htmlspecialchars($this->input->post('name', true)),
                'email'             => htmlspecialchars($email),
                'user_image'        => 'default.jpg',
                'user_phone'        => $this->input->post('user_phone'),
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id'           => 8,
                'is_active'         => 0,
                'foto_ktp'          => $dataInfo[0]['file_name'],
                'foto_lokasi'       => $dataInfo[1]['file_name'],
                'date_created'      => time()
            ];
            //Token
            // $token = base64_encode(random_bytes(25));
            // $user_token = [
            //     'email'            => $email,
            //     'token'            => $token,
            //     'date_created'    => time()
            // ];
            $this->db->insert('user', $data);
            // $this->db->insert('user_token', $user_token);
            //Kirim Email
            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Tunggu aktivasi Akun Anda</div> ');
            redirect('auth');
        }
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = './assets/img/mitra/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }
}
