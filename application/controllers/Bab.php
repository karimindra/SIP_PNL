<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bab extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bab_model', 'model');
    }
    public function index()
    {
        $data = [
            'judul' => 'Manajemen Bab',
            'bab' => $this->model->getBab()
        ];

        $this->template->render_page('bab/index', $data);
    }

    public function ajax_edit()
    {
        $id = $this->input->post('id');
        $data = $this->model->getBab($id);
        echo json_encode($data);
    }

    public function edit_bab()
    {
        if ($this->input->is_ajax_request() == true) {

            $id = $this->input->post('id');
            $nama_bab = $this->input->post('nama_bab');
            $data = $this->model->getBab($id);

            if ($data['nama_bab'] == $nama_bab) {
                $rule_nama_bab = 'required';
            } else {
                $rule_nama_bab = 'required|is_unique[tbl_bab.nama_bab]';
            }

            $this->form_validation->set_rules('nama_bab', 'Nama Bab', $rule_nama_bab);
            $this->form_validation->set_rules('isi_bab', 'Isi Bab', 'required');

            $this->form_validation->set_error_delimiters('', '');

            if ($this->form_validation->run() == false) {
                $errors = [
                    'nama_bab' => form_error('nama_bab'),
                    'isi_bab' => form_error('isi_bab'),
                ];

                $data = [
                    'status' => FALSE,
                    'errors' => $errors
                ];

                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $this->model->ubah_bab();
                $data['status'] = TRUE;
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        } else {
            //echo "error";
            redirect('bab');
        }
    }
}
