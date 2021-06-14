<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Counter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_model');
        $this->load->model('provinsi_model');
        $this->load->model('kota_model');
        $this->load->model('main_model');
        $this->load->model('saldo_model');
    }
    public function index()
    {

        $list_kota          = $this->kota_model->get_allkota();
        $search             = $this->input->post('search');
        $search_email       = $this->input->post('search_email');
        $search_kota        = $this->input->post('search_kota');


        $config['base_url']         = base_url('admin/counter/index/');
        $config['total_rows']       = count($this->user_model->total_row_counter($search, $search_email, $search_kota));
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
        $counter = $this->user_model->get_counter($limit, $start, $search, $search_email, $search_kota);
        // var_dump($counter);
        // die;

        $data = [
            'title'                 => 'Data Counter',
            'counter'               => $counter,
            'list_kota'             => $list_kota,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/counter/index'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Create
    public function create()
    {
        $provinsi       = $this->main_model->getProvinsi();
        $main_agen      = $this->user_model->get_all_mainagen();
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
                'title'         => 'Add Counter',
                'provinsi'      => $provinsi,
                'main_agen'     => $main_agen,
                'content'       => 'admin/counter/create'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $email = $this->input->post('email', true);
            $data = [
                'user_create'   => $this->session->userdata('id'),
                'user_title'    => $this->input->post('user_title'),
                'provinsi_id'   => $this->input->post('provinsi_id'),
                'kota_id'       => $this->input->post('kota_id'),
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'email'         => htmlspecialchars($email),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'id_agen'       => $this->input->post('id_agen'),
                'role_id'       => 5,
                'is_active'     => 1,
                'is_locked'     => 0,
                'date_created'  => date('Y-m-d H:i:s')
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', 'Selamat Anda berhasil mendaftar, silahkan Aktivasi akun');
            redirect('admin/counter');
        }
    }
    // Update
    public function update($id)
    {
        $user = $this->user_model->detail($id);
        $provinsi       = $this->main_model->getProvinsi();
        $main_agen      = $this->user_model->get_all_mainagen();

        $this->form_validation->set_rules(
            'name',
            'Nama',
            'required|trim',
            ['required' => 'nama harus di isi']
        );
        if ($this->form_validation->run() == false) {
            $data = [
                'title'         => 'Update Counter',
                'provinsi'      => $provinsi,
                'user'          => $user,
                'main_agen'     => $main_agen,
                'content'       => 'admin/counter/update'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $data = [
                'id'            => $id,
                'name'          => htmlspecialchars($this->input->post('name', true)),
                'provinsi_id'   => $this->input->post('provinsi_id'),
                'kota_id'       => $this->input->post('kota_id'),
                'id_agen'       => $this->input->post('id_agen'),
                'user_phone'    => $this->input->post('user_phone'),
                'user_address'  => $this->input->post('user_address'),
                'email'         => $this->input->post('email'),
                'date_updated'  => date('Y-m-d H:i:s')
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('admin/counter');
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
                'content'       => 'admin/counter/update_password'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'                => $id,
                'password'          => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Berhasil di Update');
            redirect('admin/counter');
        }
    }
    // Detail Counter
    public function detail($id)
    {
        $user_id = $this->session->userdata('id');
        $counter = $this->user_model->detail($id);

        $data = [
            'title'                 => 'Detail Counter',
            'counter'               => $counter,
            'content'               => 'admin/counter/detail'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Saldo
    public function saldo($id)
    {

        $counter = $this->user_model->detail($id);

        $data = [
            'title'                 => 'Saldo Counter',
            'counter'               => $counter,
            'content'               => 'admin/counter/saldo'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function tambah_saldo($id)
    {
        $user_type = $this->session->userdata('id');
        $counter = $this->user_model->detail($id);
        $counter_id = $counter->id;

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Saldo Counter',
                'counter'               => $counter,
                'content'               => 'admin/counter/saldo'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {


            $pemasukan               = $this->input->post('pemasukan');
            $fix_pemasukan          = preg_replace('/\D/', '', $pemasukan);

            // $pemasukan = $this->input->post('pemasukan');
            // $total_saldo = $counter->deposit_counter + $pemasukan;
            $total_saldo = (int)$counter->deposit_counter + (int)$fix_pemasukan;

            $data  = [
                'user_id'                   => $id,
                'pemasukan'                 => $fix_pemasukan,
                'keterangan'                => $this->input->post('keterangan'),
                'transaksi'                 => 0,
                'asuransi'                  => 0,
                'pengeluaran'               => 0,
                'total_saldo'               => $total_saldo,
                'user_type'                 => $user_type,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $this->saldo_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            $this->update_saldo_counter($total_saldo, $counter_id);
            redirect(base_url('admin/counter'), 'refresh');
        }
    }

    public function potong_saldo($id)
    {

        $user_type = $this->session->userdata('id');
        $counter = $this->user_model->detail($id);
        $counter_id = $counter->id;

        $this->form_validation->set_rules(
            'keterangan',
            'Keterangan',
            'required',
            array(
                'required'                        => '%s Harus Diisi',
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Saldo Counter',
                'counter'               => $counter,
                'content'               => 'admin/counter/saldo'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $pengeluaran               = $this->input->post('pengeluaran');
            $fix_pengeluaran          = preg_replace('/\D/', '', $pengeluaran);

            // $pengeluaran = $this->input->post('pengeluaran');
            $total_saldo = (int)$counter->deposit_counter - (int)$fix_pengeluaran;

            $data  = [
                'user_id'                   => $id,
                'pemasukan'                 => 0,
                'keterangan'                => $this->input->post('keterangan'),
                'transaksi'                 => 0,
                'asuransi'                  => 0,
                'pengeluaran'               => $fix_pengeluaran,
                'total_saldo'               => $total_saldo,
                'user_type'                 => $user_type,
                'date_created'              => date('Y-m-d H:i:s')
            ];
            $this->saldo_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            $this->update_saldo_counter($total_saldo, $counter_id);
            redirect(base_url('admin/counter'), 'refresh');
        }
    }

    public function update_saldo_counter($total_saldo, $counter_id)
    {
        $data = [
            'id'                => $counter_id,
            'deposit_counter'   => $total_saldo,

        ];
        $this->user_model->update($data);
    }

    public function laporan_saldo($id)
    {
        $list_kota                  = $this->kota_model->get_allkota();
        $search                     = $this->input->post('search');
        $search_email               = $this->input->post('search_email');
        $search_kota                = $this->input->post('search_kota');

        $config['base_url']         = base_url('admin/counter/laporan/' . $id . '/index');
        $config['total_rows']       = count($this->user_model->total_row_counter($search, $search_email, $search_kota));
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
        $counter = $this->user_model->get_counter($limit, $start, $search, $search_email, $search_kota);
        // var_dump($counter);
        // die;

        $data = [
            'title'                 => 'Data Counter',
            'counter'               => $counter,
            'list_kota'             => $list_kota,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/counter/index'
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
