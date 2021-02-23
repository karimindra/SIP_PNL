<?php

class Sub_bab_model extends CI_Model
{
    public function getSubBab($id = false)
    {
        if ($id == false) {
            return $this->db->select('b.*, sb.*')
                ->from('tbl_sub_bab AS sb')
                ->join('tbl_bab AS b', 'sb.bab_id=b.id')
                ->get()->result_array();
            // return $this->db->get('tbl_sub_bab')->result_array();
        } else {
            return $this->db->select('b.*, sb.*')
                ->from('tbl_sub_bab AS sb')
                ->join('tbl_bab AS b', 'sb.bab_id=b.id')
                ->where('sb.id', $id)
                ->get()->row_array();
            // return $this->db->get_where('tbl_sub_bab', ['id' => $id])->row_array();
        }
    }

    public function ubah_sub_bab()
    {
        $id = $this->input->post('id');
        $bab_id = $this->input->post('bab_id');
        $nama_sub_bab = htmlspecialchars($this->input->post('nama_sub_bab', true));
        $isi_sub_bab = htmlspecialchars($this->input->post('isi_sub_bab', true));

        $this->db->set('bab_id', $bab_id);
        $this->db->set('nama_sub_bab', $nama_sub_bab);
        $this->db->set('isi_sub_bab', $isi_sub_bab);

        $this->db->where('id', $id);
        $this->db->update('tbl_sub_bab');
        $this->session->set_flashdata('msg', 'diperbarui.');
    }
}
