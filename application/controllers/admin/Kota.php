<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kota extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kota_model');
    }
    //Index Kota
    public function index()
    {
        $kota = $this->kota_model->get_kota();
        //Validasi
        $this->form_validation->set_rules(
            'kota_name',
            'Nama Kategori',
            'required|is_unique[kota.kota_name]',
            array(
                'required'                        => '%s Harus Diisi',
                'is_unque'                        => '%s <strong>' . $this->input->post('kota_name') .
                    '</strong>Nama Kategori Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                           => 'Kota Artikel',
                'kota'                        => $kota,
                'content'                         => 'admin/kota/index_kota'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {
            $kota_slug  = url_title($this->input->post('kota_name'), 'dash', TRUE);
            $data  = [
                'kota_slug'                   => $kota_slug,
                'kota_name'                   => $this->input->post('kota_name'),
                'date_created'                    => time()
            ];
            $this->kota_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/kota'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $kota = $this->kota_model->detail_kota($id);
        //Validasi
        $this->form_validation->set_rules(
            'kota_name',
            'Nama Kategori',
            'required',
            array('required'                  => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi
            $data = [
                'title'                         => 'Edit kategori Berita',
                'kota'                      => $kota,
                'content'                       => 'admin/kota/update_kota'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {
            $data  = [
                'id'                            => $id,
                'kota_name'                 => $this->input->post('kota_name'),
                'date_updated'                  => time()
            ];
            $this->kota_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/kota'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Kota
    public function delete($id)
    {
        //Proteksi delete
        is_login();
        $kota = $this->kota_model->detail_kota($id);
        $data = ['id'   => $kota->id];
        $this->kota_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/kota'), 'refresh');
    }
}
