<?php
defined('BASEPATH') or exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class FcController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat library yang diperlukan
        $this->load->library('form_validation'); // Pastikan menggunakan 'form_validation' standard
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->Model("FcModel");
    }

    public function login()
    {
        $this->FcModel->login();
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

    // http://localhost/template_penerbitan/fotocopy
    public function fotocopy()
    {
        $data['fotocopy'] = $this->FcModel->getAllData();
        $this->load->view('header');
        $this->load->view('Transaksi/fotocopy', $data);
    }

    public function database()
    {
        $data['database'] = $this->FcModel->contoh1();
        $this->load->view('header');
        $this->load->view('fotocopy', $data);
    }

    public function tambahData()
    {
        // Menggunakan form_validation untuk validasi form
        $this->form_validation->set_rules('nomor', 'nomor', 'required');
        $this->form_validation->set_rules('id_barang', 'id_barang', 'required');
        $this->form_validation->set_rules('qty', 'qty', 'required');
        $this->form_validation->set_rules('harga_satuan', 'harga_satuan', 'required');
        $this->form_validation->set_rules('harga_total', 'harga_total', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Semua field harus diisi.');
            redirect('fotocopy');
        } else {
            // Ambil data dari form
            $data = [
                'nomor' => $this->input->post('nomor'),
                'id_barang' => $this->input->post('id_barang'),
                'qty' => $this->input->post('qty'),
                'harga_satuan' => $this->input->post('harga_satuan'),
                'harga_total' => $this->input->post('harga_total ')
            ];

            // Simpan data ke database
            $insert_nomor = $this->FcModel->tambahData($data); // Mengirimkan $data ke FcModel

            // Jika berhasil
            if ($insert_nomor) {
                redirect('fotocopy');
            } else {
                // Jika gagal
                $this->session->set_flashdata('type', 'alert-danger');
                $this->session->set_flashdata('pesan', 'Terjadi kesalahan, coba lagi.');
                redirect('fotocopy');
            }
        }
    }
    public function hapusData()
    {
        $nomor = $this->input->post('id_fc');

        if (!$nomor) {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Nomor tidak ditemukan.');
            redirect('database');
        }

        $delete = $this->FcModel->hapusData($nomor);
        if ($delete) {
            $this->session->set_flashdata('type', 'alert-success');
            $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('type', 'alert-danger');
            $this->session->set_flashdata('pesan', 'Terjadi kesalahan saat menghapus data.');
        }
        redirect('fotocopy');
    }

    public function update()
    {
        $nomor = $this->input->post('nomor');
        $id_barang = $this->input->post('id_barang');
        $qty = $this->input->post('qty');
        $harga_satuan = $this->input->post('harga_satuan');
        $harga_total = $this->input->post('harga_total');
        // Update data di database menggunakan FcModel
        $data = [
            'nomor' => $nomor,
            'id_barang' => $id_barang,
            'qty' => $qty,
            'harga_satuan' => $harga_satuan,
            'harga_total' => $harga_total,
        ];

        // Panggil FcModel untuk memperbarui data berdasarkan Nomor
        $this->FcModel->update($nomor, $data);

        // Redirect atau beri respons setelah update
        redirect('fotocopy'); // Ubah sesuai kebutuhan
    }
}
