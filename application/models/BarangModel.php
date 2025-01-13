<?php

class BarangModel extends CI_Model
{
    private $_table = 'barang';

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
                redirect('barang');
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

    // Menggunakan query builder untuk mengambil data dari barang
    public function contoh1()
    {
        return $this->db->select('id_barang, nama_barang, jenis, stok, harga')
            ->get('barang')
            ->result_array();
    }

    // Mengambil data berdasarkan input AJAX
    public function contoh2($inputAjax)
    {
        return $this->db->where('kolom', $inputAjax)
            ->get('barang')
            ->result_array();
    }
    
    public function hapusDataBarang($id_barang)
    {
        // Hapus data berdasarkan 'id_barang'
        $this->db->where('id_barang', $id_barang);
        return $this->db->delete('barang'); // Ganti 'nama_barang_tabel' dengan nama_barang tabel Anda
    }


    public function updateBarang($id_barang, $data)
    {
        $this->db->where('id_barang', $id_barang); // Kondisi berdasarkan 'id_barang'
        return $this->db->updateBarang('barang', $data); // updateBarang data di tabel 'barang'
    }

    public function tambahDataBarang($data)
    {
        // Ambil id_barang terakhir dari tabel barang
        $this->db->select('id_barang');
        $this->db->order_by('id_barang', 'DESC');
        return $this->db->insert('barang', $data);
        // $last_id_barang = $this->db->get($this->_table, 1)->row_array();

        // // Jika ada id_barang terakhir, ambil angka terakhirnya dan increment
        // if ($last_id_barang) {
        //     $last_number = (int) substr($last_id_barang['id_barang'], 3); // Ambil angka setelah 'PW_'
        //     $new_number = 'PW_' . str_pad($last_number + 1, 3, '0', STR_PAD_LEFT); // Format id_barang baru
        // } else {
        //     // Jika belum ada data, mulai dengan PW_001
        //     $new_number = 'PW_001';
        // }

        // Tambahkan id_barang ke data yang akan disimpan
        // $data['id_barang'] = $new_number;

        // Simpan data ke database
        $this->db->insert($this->_table, $data);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }



}



