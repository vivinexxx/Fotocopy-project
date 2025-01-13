<?php

class FcModel extends CI_Model
{
    private $_table = 'fotocopy';


    // Fungsi login menggunakan password hashing yang lebih aman
    public function login()
    {
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        $user = $this->db->where('id', $id)
            ->get('tabel')
            ->row_array();

        if ($user) {
            if (password_verify($password, $user['password_db'])) {
                $this->session->set_userdata('login', true);
                $this->session->set_userdata('id', $user['userId']);
                $this->session->set_flashdata('type', 'alert-success');
                $this->session->set_flashdata('pesan', '<strong>Sukses!</strong> Anda berhasil login.');
                redirect('fotocopy');
            } else {
                $this->session->set_flashdata('type', 'alert-danger');
                $this->session->set_flashdata('pesan', '<strong>Gagal!</strong> ID atau Password salah');
                redirect();
            }
        } else {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', '<strong>Gagal!</strong> ID atau Password salah');
            redirect();
        }
    }

    // Menggunakan query builder untuk mengambil data dari fotocopy
    public function contoh1()
    {
        return $this->db->select('id_fc, nomor, id_barang, harga_total')
            ->get('fotocopy')
            ->result_array();
    }

    public function getAllData()
    {
        $this->db->select('fotocopy.*, barang.nama_barang, barang.harga');
        $this->db->from('fotocopy');
        $this->db->join('barang', 'fotocopy.id_barang = barang.id_barang', 'left');
        return $this->db->get()->result_array();
    }


    // Mengambil data berdasarkan input AJAX
    public function contoh2($inputAjax)
    {
        return $this->db->where('kolom', $inputAjax)
            ->get('fotocopy')
            ->result_array();
    }
    public function hapusData($id_fc)
    {
        // Hapus data berdasarkan 'id_fc'
        $this->db->where('id_fc', $id_fc);
        return $this->db->delete('fotocopy'); // Ganti 'nama_tabel' dengan nama tabel Anda
    }

    public function update($id_fc, $data)
    {
        $this->db->where('id_fc', $id_fc); // Kondisi berdasarkan 'id_fc'
        return $this->db->update('fotocopy', $data); // Update data di tabel 'fotocopy'
    }

    public function tambahData($data)
    {
        // Ambil id_fc terakhir dari tabel fotocopy
        $this->db->select('id_fc');
        $this->db->order_by('id_fc', 'DESC');
        $last_id_fc = $this->db->get($this->_table, 1)->row_array();

        // Jika ada id_fc terakhir, ambil angka terakhirnya dan increment
        if ($last_id_fc) {
            $last_number = (int) substr($last_id_fc['id_fc'], 3); // Ambil angka setelah 'PW_'
            $new_number = 'PW_' . str_pad($last_number + 1, 3, '0', STR_PAD_LEFT); // Format id_fc baru
        } else {
            // Jika belum ada data, mulai dengan PW_001
            $new_number = 'PW_001';
        }

        // Tambahkan id_fc ke data yang akan disimpan
        $data['id_fc'] = $new_number;

        // Simpan data ke database
        $this->db->insert($this->_table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
}