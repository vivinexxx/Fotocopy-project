<?php

class Model extends CI_Model
{
    private $_table = 'pegawai';
    

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
                redirect('pegawai');
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

    // Menggunakan query builder untuk mengambil data dari pegawai
    public function contoh1()
    {
        return $this->db->select('Nomor, Nama, Alamat, Telepon')
            ->get('pegawai')
            ->result_array();
    }

    // Mengambil data berdasarkan input AJAX
    public function contoh2($inputAjax)
    {
        return $this->db->where('kolom', $inputAjax)
            ->get('pegawai')
            ->result_array();
    }
    public function hapusData($nomor)
    {
        // Hapus data berdasarkan 'Nomor'
        $this->db->where('Nomor', $nomor);
        return $this->db->delete('pegawai'); // Ganti 'nama_tabel' dengan nama tabel Anda
    }

    public function update($nomor, $data)
    {
        $this->db->where('Nomor', $nomor); // Kondisi berdasarkan 'Nomor'
        return $this->db->update('pegawai', $data); // Update data di tabel 'pegawai'
    }

    public function tambahData($data)
    {
        // Ambil nomor terakhir dari tabel pegawai
        $this->db->select('Nomor');
        $this->db->order_by('Nomor', 'DESC');
        $last_nomor = $this->db->get($this->_table, 1)->row_array();

        // Jika ada nomor terakhir, ambil angka terakhirnya dan increment
        if ($last_nomor) {
            $last_number = (int) substr($last_nomor['Nomor'], 3); // Ambil angka setelah 'PW_'
            $new_number = 'PW_' . str_pad($last_number + 1, 3, '0', STR_PAD_LEFT); // Format nomor baru
        } else {
            // Jika belum ada data, mulai dengan PW_001
            $new_number = 'PW_001';
        }

        // Tambahkan nomor ke data yang akan disimpan
        $data['Nomor'] = $new_number;

        // Simpan data ke database
        $this->db->insert($this->_table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }



}



