<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurirpusat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('provinsi_model');
        $this->load->model('main_model');
    }
    public function index()
    {
        $search = $this->input->post('search');

        $config['base_url']         = base_url('admin/kurirpusat/index/');
        $config['total_rows']       = count($this->user_model->total_row_kurirpusat($search));
        $config['per_page']         = 10;
        $config['uri_segment']      = 4;

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
        $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);
        $kurirpusat = $this->user_model->get_kurirpusat($limit, $start, $search);
        // var_dump($kurirpusat);
        // die;

        $data = [
            'title'                 => 'Data Kurir Pusat',
            'kurirpusat'             => $kurirpusat,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/kurirpusat/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Create
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

        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Add Kurir Pusat',
                'provinsi'      => $provinsi,
                'content'       => 'admin/kurirpusat/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $email = $this->input->post('email', true);
            $data = [
                'user_create'   => $this->session->userdata('id'),
                'user_title'    => $this->input->post('user_title'),
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($email),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'id_agen'       => 1,
                'role_id'       => 6,
                'is_active'     => 1,
                'is_locked'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', 'Selamat Anda berhasil mendaftar, silahkan Aktivasi akun');
            redirect('admin/kurirpusat');
        }
    }
    // Update Password
    public function update_password($id)
    {
        $user = $this->user_model->detail($id);
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
                'content'       => 'admin/kurirpusat/update_password'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                => $id,
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('admin/kurirpusat');
        }
    }
    // Update
    public function update($id)
    {
        $user = $this->user_model->detail($id);
        $provinsi       = $this->main_model->getProvinsi();
        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Update Kurir Pusat',
                'provinsi'      => $provinsi,
                'user'          => $user,
                'content'       => 'admin/kurirpusat/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'id'            => $id,
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'date_updated'  => date('Y-m-d H:i:s')
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('admin/kurirpusat');
        }
    }
    // Detail Main Agen
    public function detail($id)
    {
        $kurirpusat = $this->user_model->detail($id);
        $data = [
            'title'                 => 'Detail Kurir Pusat',
            'kurirpusat'             => $kurirpusat,
            'content'               => 'admin/kurirpusat/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Activated
    public function activated($id)
    {
        $user_detail =  $this->user_model->detail($id);
        $counter_id = $user_detail->id;
        $user_code = str_pad($counter_id, 6, '0', STR_PAD_LEFT);
        is_login();
        $data = [
            'id'                    => $id,
            'user_code'             => $user_code,
            'is_active'             => 1,
            'is_locked'             => 1,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di Aktifkan');
        redirect($_SERVER['HTTP_REFERER']);
    }
    // Banned Acount
    public function banned($id)
    {
        is_login();
        $data = [
            'id'                    => $id,
            'is_locked'             => 0,
        ];
        $this->user_model->update($data);
        $this->session->set_flashdata('message', 'User Telah di banned');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
