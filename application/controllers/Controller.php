<?php
defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat library yang diperlukan
        $this->load->library('form_validation'); // Pastikan menggunakan 'form_validation' standard
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->model("Model");
        $this->load->model("BarangModel");
    }

    public function login()
    {
        $this->Model->login();
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect();
    }

    // http://localhost/template_penerbitan/
    public function index()
    {
        $this->load->view('login');
    }

    // http://localhost/template_penerbitan/pegawai
    public function pegawai()
    {
        $data['pegawai'] = $this->Model->contoh1();
        $this->load->view('header');
        $this->load->view('Database/pegawai', $data);
    }

    public function database()
    {
        $data['database'] = $this->Model->contoh1();
        $this->load->view('header');
        $this->load->view('pegawai', $data);
    }

    public function tambahData()
    {
        // Menggunakan form_validation untuk validasi form
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('telepon', 'telepon', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Semua field harus diisi.');
            redirect('pegawai');
        } else {
            // Ambil data dari form
            $data = [
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'telepon' => $this->input->post('telepon')
            ];

            // Simpan data ke database
            $insert_nomor = $this->Model->tambahData($data); // Mengirimkan $data ke model

            // Jika berhasil
            if ($insert_nomor) {
                redirect('pegawai');
            } else {
                // Jika gagal
                $this->session->set_flashdata('type', 'alert-danger');
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan, coba lagi.');
                redirect('pegawai');
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
        redirect('pegawai');
    }

    public function update()
    {
        $nomor = $this->input->post('nomor');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $telepon = $this->input->post('telepon');

        // Update data di database menggunakan model
        $data = [
            'nama' => $nama,
            'alamat' => $alamat,
            'telepon' => $telepon,
        ];

        // Panggil model untuk memperbarui data berdasarkan Nomor
        $this->Model->update($nomor, $data);

        // Redirect atau beri respons setelah update
        redirect('pegawai'); // Ubah sesuai kebutuhan
    }
}
