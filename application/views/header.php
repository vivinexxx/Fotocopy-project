<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Judul Proyek</title>
    <link rel="icon" href="img/icon.png">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="css/modal-login.css">

    <!-- CSS jika diperlukan -->
    <style>
        textarea {
            resize: none;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book"></i>
                    <!-- cari ikon di: https://fontawesome.com/v5/search?q=laptop-medical&o=r -->
                </div>
                <div class="sidebar-brand-text mx-3">Penjualan</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUser" id="menuUser">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Login sebagai USER</span> <!-- USER = nomor pegawai -->
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="<?= base_url('Controller/logout') ?>">Logout</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo" id="menuMenu">
                    <i class="fas fa-receipt"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="Transaksi/fotocopy" style="white-space: normal;">Fotocopy</a>
                        
                        <a class="collapse-item" href="Transaksi/ATK" style="white-space: normal;">ATK</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDb"
                    aria-expanded="true" aria-controls="collapseDb" id="menuDb">
                    <i class="fa fa-database"></i>
                    <span>Database</span>
                </a>
                <div id="collapseDb" class="collapse" aria-labelledby="headingDb" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="Database/pegawai" style="white-space: normal;">Pegawai</a>
                        <a class="collapse-item" href="Database/barang" style="white-space: normal;">Barang</a>
                    </div>
                </div>

            </li>
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo" id="menuRekap">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Rekap</span>
                </a>
                <div id="collapseRekap" class="collapse" aria-labelledby="headingRekap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu:</h6>
                        <a class="collapse-item" href="Rekap/transaksi" style="white-space: normal;">Transaksi</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider my-0">
        </ul>