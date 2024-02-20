<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "db_crud";

$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));


if (isset($_POST['simpan'])) {

    if (isset($_GET['hal']) == "edit") {
        $edit = mysqli_query($koneksi, "UPDATE tbarang SET
                                                nama = '$_POST[tnama]',
                                                asal = '$_POST[tasal]',
                                                jumlah = '$_POST[tjumlah]',
                                                satuan = '$_POST[tsatuan]',
                                                tanggal_diterima = '$_POST[ttanggal_diterima]'
                                                WHERE id_barang = '$_GET[id]'");

        if ($edit) {
            echo
            "<script>
        alert('edit data sukses');
        document.location='index.php';
        </script>";
        } else {
            echo
            "<script>
        alert('edit data gagal');
        document.location='index.php';
        </script>";
        }
    } else {
        $simpan = mysqli_query($koneksi, " INSERT INTO tbarang (kode, nama, asal, jumlah, satuan, tanggal_diterima) 
        VALUE ( '$_POST[tkode]', 
                '$_POST[tnama]', 
                '$_POST[tasal]', 
                '$_POST[tjumlah]', 
                '$_POST[tsatuan]', 
                '$_POST[ttanggal_diterima]' )
                ");


        if ($simpan) {
            echo
            "<script>
            alert('simpan data sukses');
            document.location='index.php';
            </script>";
        } else {
            echo
            "<script>
            alert('simpan data gagal');
            document.location='index.php';
            </script>";
        }
    }
}

$vkode = "";
$vnama = "";
$vasal = "";
$vjumlah = "";
$vsatuan = "";
$vtanggal_diterima = "";

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {

        $tampil = mysqli_query($koneksi, "SELECT * FROM tbarang WHERE id_barang = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vkode = $data['kode'];
            $vnama = $data['nama'];
            $vasal = $data['asal'];
            $vjumlah = $data['jumlah'];
            $vsatuan = $data['satuan'];
            $vtanggal_diterima = $data['tanggal_diterima'];
        }
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang = '$_GET[id]'");

        if ($hapus) {
            echo
            "<script>
            alert('hapus data sukses');
            document.location='index.php';
            </script>";
        } else {
            echo
            "<script>
            alert('hapus data gagal');
            document.location='index.php';
            </script>";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <h3 class="text-center">DATA INVENTORI</h3>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Form input data barang
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Kode barang</label>
                                <input type="text" name="tkode" value="<?= $vkode ?>" class="form-control" placeholder="Masukkan kode barang">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama barang</label>
                                <input type="text" name="tnama" value="<?= $vnama ?>" class="form-control" placeholder="Masukkan nama barang">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Asal barang</label>
                                <select class="form-select form-select-sm" name="tasal">
                                    <option value="<?= $vnama ?>"> <?= $vasal ?></option>
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Hibah">Hibah</option>
                                    <option value="Bantuan">Bantuan</option>
                                    <option value="Sumbangan">Sumbangan</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" name="tjumlah" value="<?= $vjumlah ?>" class="form-control" placeholder="Masukkan jumlah barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <select class="form-select form-select-sm" name="tsatuan">
                                            <option value="<?= $vsatuan ?>"> <?= $vsatuan ?></option>
                                            <option value="Unit">Unit</option>
                                            <option value="Kotak">Kotak</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Box">Box</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Diterima</label>
                                        <input type="date" name="ttanggal_diterima" value="<?= $vtanggal_diterima ?>" class="form-control" placeholder="Masukkan tanggal barang">
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-outline-primary" name="simpan" type="submit">Submit</button>
                                    <button class="btn btn-outline-danger" name="bhapus" type="reset">Delete</button>
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="card-footer bg-info text-light">
                    </div>
                </div>
            </div>


        </div>

        <div class="card mt-3">
            <div class="card-header bg-info text-light">
                Data barang
            </div>
            <div class="card-body">
                <div class="col-md-5 mx-auto">
                    <form method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" value="<?= @$_POST['tcari'] ?>" class="form-control" placeholder="Masukkan kata kunci">
                            <button class="btn btn-warning" name="bcari" type="submit">cari</button>
                            <button class="btn btn-danger" name="breset" type="submit">reset</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Kode barang</th>
                        <th>Nama barang</th>
                        <th>Asal barang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Diterima</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                    $no = 1;

                    if (isset($_POST['bcari'])) {
                        $keyword = $_POST['tcari'];
                        $q = "SELECT * FROM tbarang WHERE kode like '%$keyword%' or nama like '%$keyword%' or asal like '%$keyword%'
                        or tanggal_diterima like '%$keyword%' order by id_barang desc";
                    } else {
                        $q = "SELECT * FROM tbarang order by id_barang desc";
                    }

                    $tampil = mysqli_query($koneksi, $q);
                    while ($data = mysqli_fetch_array($tampil)) {
                    ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['kode'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['asal'] ?></td>
                            <td><?= $data['jumlah'] ?> <?= $data['satuan'] ?></td>
                            <td><?= $data['tanggal_diterima']  ?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?= $data['id_barang'] ?>" class="btn btn-warning">edit</a>
                                <a href="index.php?hal=hapus&id=<?= $data['id_barang'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin hapus data ini?')">hapus</a>
                            </td>
                        </tr>

                    <?php } ?>
                </table>
            </div>
            <div class="card-footer bg-info text-light">
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>