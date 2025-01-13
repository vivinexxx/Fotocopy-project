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
                                <th>Barang</th>
                                <th>Jenis</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th class="hide-print" id="akci">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" name="tbody" style="color: black;">
                            <?php if (isset($barang) && !empty($barang)): ?>
                                <?php foreach ($barang as $row): ?>
                                    <tr>
                                        <td><?= $row['id_barang']; ?></td>
                                        <td><?= $row['nama_barang']; ?></td>
                                        <td><?= $row['jenis']; ?></td>
                                        <td><?= $row['stok']; ?></td>
                                        <td><?= $row['harga']; ?></td>
                                        <td class="hide-print">
                                            <!-- Call to action buttons -->
                                            <ul class="list-inline m-0">
                                                <!-- Tombol Edit -->
                                                <li class="list-inline-item">
                                                    <button class="btn btn-success btn-sm rounded-0" data-toggle="tooltip"
                                                        title="Edit" data-id_barang="<?= $row['id_barang'] ?>"
                                                        data-nama="<?= $row['nama_barang'] ?>" data-jenis="<?= $row['jenis'] ?>"
                                                        data-stok="<?= $row['stok'] ?>" data-harga="<?= $row['harga'] ?>"
                                                        data-toggle="modal" data-target="#modalEditData">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    </a>
                                                </li>
                                                <!-- Tombol Hapus -->
                                                <li class="list-inline-item">
                                                    <form action="<?= base_url('Barangcontroller/hapusData'); ?>" method="post"
                                                        style="display: inline;">
                                                        <input type="hidden" name="id_barang" value="<?= $row['id_barang']; ?>">
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
<div class="modal fade" id="modaltambahDataBarang" tabindex="-1" role="dialog"
    aria-labelledby="modaltambahDataBarangLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltambahDataBarangLabel">Tambah Data Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('BarangController/tambahDataBarang') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">nama_barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">jenis</label>
                        <textarea class="form-control" id="jenis" name="jenis" placeholder="Masukkan jenis"
                            required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="stok">stok</label>
                        <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukkan stok"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="harga">harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan harga"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
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
                    <!-- Hidden field for ID or id_barang -->
                    <input type="hidden" id="id_barang" name="id_barang" required>

                    <div class="form-group">
                        <label for="nama">nama_barang</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">jenis</label>
                        <textarea class="form-control" id="jenis" name="jenis" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="stok">stok</label>
                        <input type="text" class="form-control" id="stok" name="stok"" required>
                    </div>
                    <div class=" form-group">
                        <label for="harga">harga</label>
                        <input type="text" class="form-control" id="harga" name="harga"" required>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                        <img id="previewGambar" src="" alt="Preview Gambar" class="img-fluid mt-2" style="max-height: 200px;">
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
                <p><strong>id_barang:</strong> <span id="detailid_barang"></span></p>
                <p><strong>nama_barang:</strong> <span id="detailNama"></span></p>
                <p><strong>jenis:</strong> <span id="detailjenis"></span></p>
                <p><strong>stok:</strong> <span id="detailstok"></span></p>
                <p><strong>harga:</strong> <span id="detailharga"></span></p>
                <p><strong>Gambar:</strong></p>
                <img id="detailGambar" src="" alt="Gambar Barang" class="img-fluid" style="max-height: 300px;">
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
            $('#modaltambahDataBarang').modal('show');
        });

        // Proses submit form tambah data
        $('#formtambahDataBarang').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman

            var formData = $(this).serialize(); // Mengambil data dari form

            $.ajax({
                url: "<?php echo base_url('Insert/contoh2'); ?>", // Endpoint untuk menyimpan data
                method: "POST",
                data: formData,
                success: function (response) {
                    $('#modaltambahDataBarang').modal('hide'); // Sembunyikan modal
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
    const id_barang = $(this).data('id_barang');
    const nama = $(this).data('nama');
    const jenis = $(this).data('jenis');
    const stok = $(this).data('stok');
    const harga = $(this).data('harga');
    const gambar = $(this).data('gambar'); // Ambil URL gambar dari atribut data

    // Set data ke dalam form modal
    $('#modalEditData #id_barang').val(id_barang);
    $('#modalEditData #nama').val(nama);
    $('#modalEditData #jenis').val(jenis);
    $('#modalEditData #stok').val(stok);
    $('#modalEditData #harga').val(harga);

    // Set URL gambar ke elemen <img> untuk preview
    if (gambar) {
        $('#modalEditData #previewGambar').attr('src', gambar).show();
    } else {
        $('#modalEditData #previewGambar').hide(); // Sembunyikan jika tidak ada gambar
    }

    // Tampilkan modal
    $('#modalEditData').modal('show');
});

// Preview gambar baru yang diunggah
$('#modalEditData #gambar').on('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#modalEditData #previewGambar').attr('src', e.target.result).show();
        };
        reader.readAsDataURL(file);
    }
});

    $(document).ready(function () {
        // Menampilkan modal saat tombol "Tambah data" diklik
        $('button.btn-primary').on('click', function () {
            $('#modaltambahDataBarang').modal('show');
        });

        // Proses submit form tambah data
        $('#formtambahDataBarang').on('submit', function (e) {
            e.preventDefault(); // Mencegah reload halaman

            var formData = $(this).serialize(); // Mengambil data dari form

            $.ajax({
                url: "<?php echo base_url('Insert/contoh2'); ?>", // Endpoint untuk menyimpan data
                method: "POST",
                data: formData,
                success: function (response) {
                    $('#modaltambahDataBarang').modal('hide'); // Sembunyikan modal
                    alert("Data berhasil ditambahkan!");
                    location.reload(); // Refresh halaman untuk melihat data baru (opsional)
                },
            });
        });

        // Proses tombol Edit
        $(document).on('click', '.btn-success', function () {
            const id_barang = $(this).data('id_barang');
            const nama = $(this).data('nama')
            const jenis = $(this).data('jenis');
            const stok = $(this).data('stok');
            const harga = $(this).data('harga');

            $('#modalEditData #id_barang').val(id_barang);
            $('#modalEditData #nama').val(nama);
            $('#modalEditData #jenis').val(jenis);
            $('#modalEditData #stok').val(stok);
            $('#modalEditData #harga').val(harga);
            $('#modalEditData').modal('show');
            // hide modal
            $('#detailModal').modal('hide');
        });
    });
    $(document).ready(function () {
    $('#tabel tbody').on('dblclick', 'tr', function () {
        var id_barang = $(this).find('td:eq(0)').text();
        var nama = $(this).find('td:eq(1)').text();
        var jenis = $(this).find('td:eq(2)').text();
        var stok = $(this).find('td:eq(3)').text();
        var harga = $(this).find('td:eq(4)').text();
        var gambar = $(this).find('td:eq(5)').text(); // Asumsi URL gambar ada di kolom ke-6 (index ke-5)

        // Masukkan data ke dalam modal
        $('#detailid_barang').text(id_barang);
        $('#detailNama').text(nama);
        $('#detailjenis').text(jenis);
        $('#detailstok').text(stok);
        $('#detailharga').text(harga);

        // Masukkan URL gambar ke dalam atribut src elemen img
        $('#detailGambar').attr('src', gambar);

        // Tampilkan modal
        $('#detailModal').modal('show');
    });
});

</script>

</body>

</html>