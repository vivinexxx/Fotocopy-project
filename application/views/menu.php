<?php
defined('BASEPATH') or exit('No direct script access allowed');

//if (!isset($_SESSION["id"])) { //jika tidak ada id
//    $this->session->set_flashdata('type', 'alert-danger');
//    $this->session->set_flashdata('pesan', '<strong>Error!</strong> Anda harus login terlebih dahulu');
//    redirect();
//    exit;
//}

?>
<!-- untuk daftar menu dst, cek header.php-->

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
                                <th style="width:10px">Nomor</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" name="tbody" style="color: black;">
                            <?php if (isset($menu) && !empty($menu)): ?>
                                <?php foreach ($menu as $row): ?>
                                    <tr>
                                        <td><?= $row['Nomor'] ?></td>
                                        <td><?= $row['Nama'] ?></td>
                                        <td><?= $row['Alamat'] ?></td>
                                        <td><?= $row['Telepon'] ?></td>
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


    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>© <?php echo date("Y"); ?> PT Kanisius.</span>
            </div>
        </div>
    </footer>

</div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap and other required libraries -->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.js"></script>

<!-- Include DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<!-- Include Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<!-- Include DataTables and Buttons JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<!-- Include JSZip (for CSV/Excel export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>

<!-- Include pdfMake and vfs_fonts for PDF Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- Include Buttons Print JS -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script>
    // gunakan Javascript dan jQuery

    $(document).ready(function () { // jika jalaman web selesai diload, maka jalankan script ini
        $('#menuMenu').trigger('click');

        //getContoh1();

        $('#tabel').DataTable({
            "scrollX": true,
            "select": true,
            "bSort": false,
            dom: 'Bfrtip', // Menambahkan tombol di atas tabel
            buttons: [
                'csv', 'excel', 'pdf', 'print' // Menambahkan tombol-tombol ekspor
            ]
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
</script>

</body>

</html>