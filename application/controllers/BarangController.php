<?php
defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class BarangController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat library yang diperlukan
        $this->load->library('form_validation'); // Pastikan menggunakan 'form_validation' standard
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->model("BarangModel");
        // $this->load->model("BarangModel");
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

    public function barang()
    {
        $data['barang'] = $this->BarangModel->contoh1();
        $this->load->view('header');
        $this->load->view('Database/barang', $data);
    }

    public function databasebarang()
    {
        $data['database'] = $this->Model->contoh1();
        $this->load->view('header');
        $this->load->view('Database/barang', $data);
    }

    public function tambahDataBarang()
    {
        // Menggunakan form_validation untuk validasi form
        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'required');
        $this->form_validation->set_rules('jenis', 'jenis', 'required');
        $this->form_validation->set_rules('stok', 'stok', 'required');
        $this->form_validation->set_rules('harga', 'harga', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Semua field harus diisi.');
            redirect('barang');
        } else {
            // Ambil data dari form
            $data = [
                'id_barang' => $this->input->post('id_barang'),
                'nama_barang' => $this->input->post('nama_barang'),
                'jenis_barang' => $this->input->post('jenis_barang'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga')
            ];
            

            // Simpan data ke database
            $insert_nomor = $this->BarangModel->tambahData($data);
            // Proses upload gambar
            if (!empty($_FILES['gambar']['name'])) {
                $config['upload_path'] = './uploads/barang/'; // Lokasi folder penyimpanan
                $config['allowed_types'] = 'jpg|jpeg|png'; // Jenis file yang diizinkan
                $config['max_size'] = 2048; // Maksimal ukuran file dalam KB
                $config['file_name'] = uniqid('barang_'); // Nama file unik

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar')) {
                    // Jika upload berhasil
                    $uploadData = $this->upload->data();
                    $data['gambar'] = $uploadData['file_name']; // Simpan nama file ke dalam data
                } else {
                    // Jika upload gagal
                    $this->session->set_flashdata('type', 'alert-danger');
                    $this->session->set_flashdata('pesan', $this->upload->display_errors());
                    redirect('barang');
                }
            }

            if ($insert_nomor) {
                $this->session->set_flashdata('type', 'alert-success');
                $this->session->set_flashdata('pesan', 'Data barang berhasil ditambahkan.');
                redirect('barang');
            } else {
                $this->session->set_flashdata('type', 'alert-danger');
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan, coba lagi.');
                redirect('barang');
            }


            // Simpan data ke database
            $insert_nomor = $this->Model->tambahData($data); // Mengirimkan $data ke model

            // Jika berhasil
            if ($insert_nomor) {
                redirect('database');
            } else {
                // Jika gagal
                $this->session->set_flashdata('type', 'alert-danger');
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan, coba lagi.');
                redirect('barang');
            }
        }
    }
    public function hapusDataBarang()
    {
        $nomor = $this->input->post('nomor');

        if (!$nomor) {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Nomor tidak ditemukan.');
            redirect('barang');
        }

        $delete = $this->Model->hapusDataBarang($nomor);
        if ($delete) {
            $this->session->set_flashdata('type', 'alert-success');
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Terjadi kesalahan saat menghapus data.');
        }
        redirect('barang');
    }

    public function updateBarang()
    {
        $id_barang = $this->input->post('id_barang');
        $nama_barang = $this->input->post('nama_barang');
        $jenis_barang = $this->input->post('jenis_barang');
        $stok = $this->input->post('stok');
        $harga = $this->input->post('harga');

        // Update data di database menggunakan model
        $data = [
            'id_barang' => $id_barang,
            'nama_barang' => $nama_barang,
            'jenis_barang' => $jenis_barang,
            'stok' => $stok,
            'harga' => $harga,
        ];

        // Panggil model untuk memperbarui data berdasarkan Nomor
        $this->Model->update($id_barang, $data);

        // Redirect atau beri respons setelah update
        redirect('barang'); // Ubah sesuai kebutuhan
    }

}
