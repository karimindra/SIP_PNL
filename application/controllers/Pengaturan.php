<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logout();

        $this->user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Pengaturan_model', 'pengaturan');
    }

    // Pengguna
    public function pengguna()
    {
        is_admin();

        $this->form_validation->set_rules('pengguna', 'Pengguna', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'user' => $this->user,
                'judul' => 'Daftar Pengguna',
                'pengguna' => $this->pengaturan->getPengguna()
            ];

            $this->template->render_page('settings/pengguna', $data);
        } else {
            $this->pengaturan->insertRole();
        }
    }

    public function penggunaTambah()
    {
        is_admin();

        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[8]|matches[pass2]');
        $this->form_validation->set_rules('pass2', 'Konfirmasi Password', 'required|trim|matches[pass1]');

        if ($this->form_validation->run() == false) {
            $data = [
                'user' => $this->user,
                'judul' => 'Tambah Pengguna',
                'pengguna' => $this->pengaturan->getPengguna(),
                'role' => $this->pengaturan->getRole()
            ];

            $this->template->render_page('settings/pengguna-tambah', $data);
        } else {
            // encrypt password before inserting to database
            $password = password_hash($this->input->post('pass1'), PASSWORD_DEFAULT);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => $password,
                'image' => 'default.svg',
                'role_id' => $this->input->post('role_id'),
                'date_created' => time()
            ];

            // insert data to table `user`
            $this->db->insert('user', $data);

            $this->session->set_flashdata('msg', 'ditambahkan.');
            redirect('pengaturan/pengguna');
        }
    }

    public function penggunaHapus()
    {
        is_admin();

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('user');
        $this->session->set_flashdata('msg', 'dihapus.');
        redirect('pengaturan/pengguna');
    }

    // Role
    public function role()
    {
        is_admin();

        $data = [
            'user' => $this->user,
            'judul' => 'Daftar Role',
            'role' => $this->pengaturan->getRole()
        ];

        $this->template->render_page('settings/role', $data);
    }

    public function role_tambah()
    {
        is_admin();

        $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.role]');

        if ($this->form_validation->run() == false) {
            echo json_encode(['error' => form_error('role')]);
        } else {
            $this->pengaturan->insertRole();
        }
    }

    public function role_ubah()
    {
        is_admin();

        $id = $this->input->post('id');
        $role = $this->input->post('role', true);
        $data = $this->pengaturan->getRole($id);

        if ($role == $data['role']) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[user_role.role]';
        }

        $this->form_validation->set_rules('role', 'Role', $rules);

        if ($this->form_validation->run() == false) {
            echo json_encode(['error' => form_error('role')]);
        } else {
            $this->pengaturan->updateRole($id, $role);
        }
    }

    public function roleHapus()
    {
        is_admin();

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('msg', 'dihapus.');
        redirect('pengaturan/role');
    }

    // Jabatan
    public function jabatan()
    {
        $data = [
            'user' => $this->user,
            'judul' => 'Daftar Klasifikasi',
            'jabatan' => $this->pengaturan->getJabatan()
        ];

        $this->template->render_page('settings/jabatan', $data);
    }

    public function jabatan_tambah()
    {
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|is_unique[jabatan.jabatan]');

        if ($this->form_validation->run() == false) {
            echo json_encode(['error' => form_error('jabatan')]);
        } else {
            $this->pengaturan->insertJabatan();
        }
    }

    public function jabatan_ubah()
    {
        $id = $this->input->post('id');
        $jabatan = $this->input->post('jabatan', true);
        $data = $this->pengaturan->getJabatan($id);

        if ($jabatan == $data['jabatan']) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[jabatan.jabatan]';
        }

        $this->form_validation->set_rules('jabatan', 'Jabatan', $rules);

        if ($this->form_validation->run() == false) {
            echo json_encode(['error' => form_error('jabatan')]);
        } else {
            $this->pengaturan->updateJabatan($id, $jabatan);
        }
    }

    public function jabatanHapus()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('jabatan');
        $this->session->set_flashdata('msg', 'dihapus.');
        redirect('pengaturan/jabatan');
    }

    // Sifat Surat
    public function sifat()
    {
        $data = [
            'user' => $this->user,
            'judul' => 'Daftar Sifat Surat',
            'sifat' => $this->pengaturan->getSifat()
        ];

        $this->template->render_page('settings/sifat', $data);
    }

    public function sifat_tambah()
    {
        $this->form_validation->set_rules('sifat', 'Sifat', 'required|is_unique[sifat.sifat]');

        if ($this->form_validation->run() == false) {
            echo json_encode(['error' => form_error('sifat')]);
        } else {
            $this->pengaturan->insertSifat();
        }
    }

    public function sifat_ubah()
    {
        $id = $this->input->post('id');
        $sifat = $this->input->post('sifat', true);
        $data = $this->pengaturan->getSifat($id);

        if ($sifat == $data['sifat']) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[sifat.sifat]';
        }

        $this->form_validation->set_rules('sifat', 'Sifat', $rules);

        if ($this->form_validation->run() == false) {
            echo json_encode(['error' => form_error('sifat')]);
        } else {
            $this->pengaturan->updateSifat($id, $sifat);
        }
    }

    public function sifatHapus()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('sifat');
        $this->session->set_flashdata('msg', 'dihapus.');
        redirect('pengaturan/sifat');
    }
}
