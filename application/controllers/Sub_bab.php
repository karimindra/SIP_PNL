<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_bab extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sub_bab_model', 'model');
    }

    public function index()
    {
        $data = [
            'judul' => 'Manajemen Sub Bab',
            'data' => $this->model->getSubBab()
        ];

        $this->template->render_page('sub_bab/index', $data);
    }

    public function edit($id)
    {
        $data = [
            'judul' => 'Edit Data Sub Bab',
            'data' => $this->model->getSubBab($id)
        ];

        $this->template->render_page('sub_bab/edit', $data);
    }

    public function edit_subbab()
    {
        if (isset($_POST['ubah'])) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama_sub_bab');
            $data = $this->model->getSubBab($id);

            if ($data['nama_sub_bab'] == $nama) {
                $rule_nama = 'required';
            } else {
                $rule_nama = 'required|is_unique[tbl_sub_bab.nama_sub_bab]';
            }

            $this->form_validation->set_rules('nama_sub_bab', 'Sub Bab', $rule_nama);
            $this->form_validation->set_rules('isi_sub_bab', 'Isi Sub Bab', 'required');

            if ($this->form_validation->run() == false) {
                $data = [
                    'judul' => 'Edit Data Sub Bab',
                    'data' => $this->model->getSubBab($id)
                ];

                $this->template->render_page('sub_bab/edit', $data);
            } else {
                $this->model->ubah_sub_bab();
                redirect('sub_bab');
            }
        } else {
            redirect('sub_bab');
        }
    }
}
