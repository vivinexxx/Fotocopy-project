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

    // http://localhost/template_penerbitan/menu
    public function menu()
    {
        $data['menu'] = $this->Model->contoh1();
        $this->load->view('header');
        $this->load->view('menu', $data);
    }

    public function database()
    {
        $data['database'] = $this->Model->contoh1();
        $this->load->view('header');
        $this->load->view('database', $data);
    }


}
