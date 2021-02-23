<?php

class Sub_bab_model extends CI_Model
{
    public function getSubBab($id = false)
    {
        if ($id == false) {
            return $this->db->select('b.nama_bab as bab, sb.*')
                ->from('tbl_sub_bab AS sb')
                ->join('tbl_bab AS b', 'sb.bab_id=b.id')
                ->get()->result_array();
            // return $this->db->get('tbl_sub_bab')->result_array();
        } else {
            return $this->db->select('b.nama_bab as bab, sb.*')
                ->from('tbl_sub_bab AS sb')
                ->join('tbl_bab AS b', 'sb.bab_id=b.id')
                ->where('sb.id', $id)
                ->get()->row_array();
            // return $this->db->get_where('tbl_sub_bab', ['id' => $id])->row_array();
        }
    }

    public function ubah_bab()
    {
        $id = $this->input->post('id');
        $nama_bab = htmlspecialchars($this->input->post('nama_bab', true));
        $isi_bab = htmlspecialchars($this->input->post('isi_bab', true));

        $this->db->set('nama_bab', $nama_bab);
        $this->db->set('isi_bab', $isi_bab);

        $this->db->where('id', $id);
        $this->db->update('tbl_bab');
        $this->session->set_flashdata('msg', 'diperbarui.');
    }
}
