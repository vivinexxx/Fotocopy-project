<?php

defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class PegawaiController extends CI_Controller
{
    Public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->model("Model");
    }
    public function tambahData()
    {
        // Menggunakan form_validation untuk validasi form
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Semua field harus diisi.');
            redirect('database');
        } else {
            // Ambil data dari form
            $data = [
                'Nama' => $this->input->post('nama'),
                'Alamat' => $this->input->post('alamat'),
                'Telepon' => $this->input->post('telepon')
            ];

            // Simpan data ke database
            $insert_nomor = $this->Model->tambahData($data); // Mengirimkan $data ke model

            // Jika berhasil
            if ($insert_nomor) {
                redirect('database');
            } else {
                // Jika gagal
                $this->session->set_flashdata('type', 'alert-danger');
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan, coba lagi.');
                redirect('database');
            }
        }
    }
    public function hapusData()
    {
        $nomor = $this->input->post('nomor');

        if (!$nomor) {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Nomor tidak ditemukan.');
            redirect('database');
        }

        $delete = $this->Model->hapusData($nomor);
        if ($delete) {
            $this->session->set_flashdata('type', 'alert-success');
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Terjadi kesalahan saat menghapus data.');
        }
        redirect('database');
    }

    public function update()
    {
        $nomor = $this->input->post('nomor');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');

        // Update data di database menggunakan model
        $data = [
            'Nama' => $nama,
            'Alamat' => $alamat,
            'Telepon' => $telepon,
        ];

        // Panggil model untuk memperbarui data berdasarkan Nomor
        $this->Model->update($nomor, $data);

        // Redirect atau beri respons setelah update
        redirect('database'); // Ubah sesuai kebutuhan
    }
}