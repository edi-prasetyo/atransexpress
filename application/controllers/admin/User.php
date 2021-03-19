<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
    $list_user = $this->user_model->get_admin();
    $data = [
      'title'                 => 'Data User',
      'list_user'             => $list_user,
      'content'               => 'admin/user/index_user'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function agen()
  {
    $user_agen = $this->user_model->get_agen();
    $data = [
      'title'                 => 'Data Agen',
      'user_agen'             => $user_agen,
      'content'               => 'admin/user/index_agen'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // Create Counter
  public function create_agen()
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
        'title'         => 'Add Main Agen',
        'provinsi'      => $provinsi,
        'content'       => 'admin/user/create_agen'
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
        'user_image'    => 'default.jpg',
        'user_phone'    => $this->input->post('user_phone'),
        'user_address'  => $this->input->post('user_address'),
        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id'       => 4,
        'is_active'     => 1,
        'is_locked'     => 0,
        'date_created'  => time()
      ];
      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
      redirect('admin/user/agen');
    }
  }
  public function counter()
  {

    $user_counter = $this->user_model->get_counter();
    $data = [
      'title'                     => 'Data Counter',
      'user_counter'              => $user_counter,
      'content'                   => 'admin/user/index_counter'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  //Detail User
  public function detail($id)
  {
    $user_detail =  $this->user_model->detail($id);
    $data = [
      'title'                 => 'Data User',
      'user_detail'           => $user_detail,
      'content'               => 'admin/user/detail_user'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  // Create Counter
  public function create_counter()
  {
    $user_agen      = $this->user_model->get_agen();
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
        'title'         => 'Add Counter',
        'provinsi'      => $provinsi,
        'user_agen'     => $user_agen,
        'content'       => 'admin/user/create_counter'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {

      $email = $this->input->post('email', true);
      $data = [
        'user_create'   => $this->session->userdata('id'),
        'user_title'    => $this->input->post('user_title'),
        'provinsi_id'   => $this->input->post('provinsi_id'),
        'kota_id'       => $this->input->post('kota_id'),
        'id_agen'     => $this->input->post('id_agen'),
        'name'          => htmlspecialchars($this->input->post('name', true)),
        'email'         => htmlspecialchars($email),
        'user_image'    => 'default.jpg',
        'user_phone'    => $this->input->post('user_phone'),
        'user_address'  => $this->input->post('user_address'),
        'password'      => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
        'role_id'       => 5,
        'is_active'     => 1,
        'is_locked'     => 0,
        'date_created'  => time()
      ];
      $this->db->insert('user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
      redirect('admin/user/counter');
    }
  }
  public function update_counter($id)
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
        'title'         => 'Update Counter',
        'provinsi'      => $provinsi,
        'user'          => $user,
        'content'       => 'admin/user/update_counter'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    } else {


      $data = [
        'id'            => $id,
        'provinsi_id'   => $this->input->post('provinsi_id'),
        'kota_id'       => $this->input->post('kota_id'),
        'name'          => htmlspecialchars($this->input->post('name', true)),
        'user_phone'    => $this->input->post('user_phone'),
        'user_address'  => $this->input->post('user_address'),
        'date_updated'  => time()
      ];
      $this->user_model->update($data);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
      redirect('admin/user/counter');
    }
  }
  public function activated_counter($id)
  {
    $user_detail =  $this->user_model->detail($id);
    $counter_id = $user_detail->id;
    $counter_code = str_pad($counter_id, 6, '0', STR_PAD_LEFT);
    is_login();
    $data = [
      'id'                    => $id,
      'counter_code'          => $counter_code,
      'is_locked'             => 1,
    ];
    $this->user_model->update($data);
    $this->session->set_flashdata('message', 'User Telah di Aktifkan');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
