<?php
defined('BASEPATH') or exit('No direct script access allowed');

//if (!isset($_SESSION["id"])) { //jika tidak ada id
//    $this->session->set_flashdata('type', 'alert-danger');
//    $this->session->set_flashdata('pesan', '<strong>Error!</strong> Anda harus login terlebih dahulu');
//    redirect();
//    exit;
//}

?>
<style>
    @media print {

        /* Hide action icons and buttons during printing */
        .fa,
        .btn,
        .hide-print {
            display: none !important;
        }


        .btn-custom {
            padding: 10px 20px;
            /* Padding untuk ukuran tombol */
            font-size: 16px;
            /* Ukuran font */
            border-radius: 5px;
            /* Membulatkan sudut */
            border: none;
            /* Hilangkan border default */
            display: inline-flex;
            /* Untuk ikon dan teks sejajar */
            align-items: center;
            justify-content: center;
            gap: 5px;
            /* Jarak antara ikon dan teks */
            color: #fff;
            /* Warna teks */
            cursor: pointer;
            /* Pointer saat hover */
        }

        .btn-primary {
            background-color: #4b0082;
            /* Warna ungu untuk Tambah data */
        }

        .btn-info {
            background-color: #40b4c4;
            /* Warna biru untuk Print */
        }

        .btn-custom:hover {
            opacity: 0.9;
            /* Efek hover */
        }

    }
</style>
<!-- untuk daftar menu dst, cek header.php-->
<!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<div id="content-wrapper" class="d-flex flex-column">

    <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <ul class="navbar-nav ml-auto">
                <img src="img/kanisius.png">

            </ul>
        </nav>
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Daftar Pegawai</h1>
            </div>
            <div>
                <table>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-custom btn-primary">
                                Tambah data
                            </button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <?php if (isset($_SESSION["pesan"])) { ?>
                        <div class="alert <?= $_SESSION['type'] ?> alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?= $_SESSION['pesan'] ?>

                        </div>
                        <?php unset($_SESSION['pesan']);
                    } ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table id="tabel" class="display nowrap" style="width:100%">
                        <thead style="color: black;">
                            <tr>
                                <th style="width:10px">No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th class="hide-print" id="akci">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" name="tbody" style="color: black;">
                            <?php if (isset($database) && !empty($database)): ?>
                                <?php foreach ($database as $row): ?>
                                    <tr>
                                        <td><?= $row['Nomor']; ?></td>
                                        <td><?= $row['Nama']; ?></td>
                                        <td><?= $row['Alamat']; ?></td>
                                        <td><?= $row['Telepon']; ?></td>
                                        <td class="hide-print">
                                            <!-- Call to action buttons -->
                                            <ul class="list-inline m-0">
                                                <!-- Tombol Edit -->
                                                <li class="list-inline-item">
                                                    <button class="btn btn-success btn-sm rounded-0" data-toggle="tooltip"
                                                        title="Edit" data-nomor="<?= $row['Nomor'] ?>"
                                                        data-nama="<?= $row['Nama'] ?>" data-alamat="<?= $row['Alamat'] ?>"
                                                        data-telepon="<?= $row['Telepon'] ?>" data-toggle="modal"
                                                        data-target="#modalEditData">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    </a>
                                                </li>
                                                <!-- Tombol Hapus -->
                                                <li class="list-inline-item">
                                                    <form action="<?= base_url('controller/hapusData'); ?>" method="post"
                                                        style="display: inline;">
                                                        <input type="hidden" name="nomor" value="<?= $row['Nomor']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm rounded-0"
                                                            data-toggle="tooltip" title="Delete"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" style="text-align:center;">Data tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <br>
        </div>

    </div>

    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>© <?php echo date("Y"); ?> PT Kanisius.</span>
            </div>
        </div>
    </footer>

</div>

</div>
<!-- Modal Tambah Data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" role="dialog" aria-labelledby="modalTambahDataLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahDataLabel">Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('Controller/tambahData') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon"
                            placeholder="Masukkan nomor telepon" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Data -->
<div class="modal fade" id="modalEditData" tabindex="-1" role="dialog" aria-labelledby="modalEditDataLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditDataLabel">Edit Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('update') ?>" method="POST">
                <div class="modal-body">
                    <!-- Hidden field for ID or Nomor -->
                    <input type="hidden" id="nomor" name="nomor" required>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" class="form-control" id="telepon" name="telepon"" required>
                    </div>
                </div>
                <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nomor:</strong> <span id="detailNomor"></span></p>
                <p><strong>Nama:</strong> <span id="detailNama"></span></p>
                <p><strong>Alamat:</strong> <span id="detailAlamat"></span></p>
                <p><strong>Telepon:</strong> <span id="detailTelepon"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.js"></script>

<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="vendor/datatables/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="vendor/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="vendor/datatables/dataTables.select.min.js"></script>


<script>
    // gunakan Javascript dan jQuery

    $(document).ready(function () { // jika jalaman web selesai diload, maka jalankan script ini
        $('#menuDb').trigger('click');

        //getContoh1();

        $('#tabel').DataTable({
            "scrollX": true,
            "select": true,
            "bSort": false,
        });
    });

    // menggunakan AJAX untuk membuat tabel dari data tabel
    // AJAX (View) -> Controller -> Model -> dapat hasil
    function getContoh1() {
        var html = '';
        var no = 1;

        $.ajax({
            url: "<?php echo base_url('Select/contoh1'); ?>",
            method: "POST",
            dataType: "JSON",
            async: false,
            success: function (data) {
                for (var i = 0; i < data.length; i++) {

                    html += '<tr>';
                    html += '<td>' + no + '</td>';
                    html += '<td></td>';
                    html += '<td></td>';
                    html += '<td></td>';
                    html += '</tr>';

                    no++;
                }
                $("#tbody").html(html);
            }
        });
    }

    // kalau butuh input dari user
    function getContoh2() {
        var test = 'test';
        // var test = $('#nama_input_id).val();

        var url = "<?php echo base_url('Insert/contoh2?'); ?>";
        var urlBaru = url + "inputAjax=" + test;

        var html = '';
        var no = 1;

        $.ajax({
            url: urlBaru,
            method: "POST",
            dataType: "JSON",
            async: false,
            success: function (data) {
                for (var i = 0; i < data.length; i++) {

                    html += '<tr>';
                    html += '<td>' + no + '</td>';
                    html += '<td></td>';
                    html += '<td></td>';
                    html += '<td></td>';
                    html += '</tr>';

                    no++;
                }
                $("#tbody").html(html);
            }
        });
    }
    $(document).ready(function () {
        // Menampilkan modal saat tombol "Tambah data" diklik
        $('button.btn-primary').on('click', function () {
            $('#modalTambahData').modal('show');
        });

        // Proses submit form tambah data
        $('#formTambahData').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman

            var formData = $(this).serialize(); // Mengambil data dari form

            $.ajax({
                url: "<?php echo base_url('Insert/contoh2'); ?>", // Endpoint untuk menyimpan data
                method: "POST",
                data: formData,
                success: function (response) {
                    $('#modalTambahData').modal('hide'); // Sembunyikan modal
                    alert("Data berhasil ditambahkan!");
                    location.reload(); // Refresh halaman untuk melihat data baru (opsional)
                },
                // error: function (xhr, status, error) {
                //     alert("Terjadi kesalahan: " + error);
                // }
            });
        });
    });
    $(document).on('click', '.btn-success', function () {
        // Ambil data dari tombol edit yang diklik
        const nomor = $(this).data('nomor');
        const nama = $(this).data('nama');
        const alamat = $(this).data('alamat');
        const telepon = $(this).data('telepon');

        // Set data ke dalam form modal
        $('#modalEditData #nomor').val(nomor);
        $('#modalEditData #nama').val(nama);
        $('#modalEditData #alamat').val(alamat);
        $('#modalEditData #telepon').val(telepon);

        // Tampilkan modal
        $('#modalEditData').modal('show');
    });
    $(document).ready(function () {
        // Menampilkan modal saat tombol "Tambah data" diklik
        $('button.btn-primary').on('click', function () {
            $('#modalTambahData').modal('show');
        });

        // Proses submit form tambah data
        $('#formTambahData').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman

            var formData = $(this).serialize(); // Mengambil data dari form

            $.ajax({
                url: "<?php echo base_url('Insert/contoh2'); ?>", // Endpoint untuk menyimpan data
                method: "POST",
                data: formData,
                success: function (response) {
                    $('#modalTambahData').modal('hide'); // Sembunyikan modal
                    alert("Data berhasil ditambahkan!");
                    location.reload(); // Refresh halaman untuk melihat data baru (opsional)
                },
            });
        });

        // Proses tombol Edit
        $(document).on('click', '.btn-success', function () {
            const nomor = $(this).data('nomor');
            const nama = $(this).data('nama');
            const alamat = $(this).data('alamat');
            const telepon = $(this).data('telepon');

            $('#modalEditData #nomor').val(nomor);
            $('#modalEditData #nama').val(nama);
            $('#modalEditData #alamat').val(alamat);
            $('#modalEditData #telepon').val(telepon);

            $('#modalEditData').modal('show');
        });
    });
    $(document).ready(function () {
        $('#tabel tbody').on('click', 'tr', function () {
            var nomor = $(this).find('td:eq(0)').text();
            var nama = $(this).find('td:eq(1)').text();
            var alamat = $(this).find('td:eq(2)').text();
            var telepon = $(this).find('td:eq(3)').text();

            // Masukkan data ke dalam modal
            $('#detailNomor').text(nomor);
            $('#detailNama').text(nama);
            $('#detailAlamat').text(alamat);
            $('#detailTelepon').text(telepon);

            // Tampilkan modal
            $('#detailModal').modal('show');
        });
    });
</script>

</body>

</html>