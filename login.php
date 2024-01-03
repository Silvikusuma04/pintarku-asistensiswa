<?php
session_start();

$nim = @$_POST['nim'];
$nama = @$_POST['nama'];
$file = "file/" . $nim . "-" . $nama . ".txt";

// jika ditekan tombol pengguna baru
if (isset($_POST['pengguna_baru'])) {
    // Periksa apakah file sudah ada
    if (!file_exists($file)) {
        // Buat file baru
        $fh = fopen($file, "w");
        fclose($fh);
        $alert = "<div class='alert alert-success'>Selamat Datang Teman-Teman Baru</div>";
        $_SESSION['nim'] = $nim;
        $_SESSION['nama'] = $nama;
        echo "<meta http-equiv='refresh' content='2; url=index.php'>";
    } else {
        $alert = "<div class='alert alert-danger'>Anda gagal bergabung bersama kami. Silakan daftar ulang.</div>";
    }
}
// jika ditekan tombol masuk
elseif (isset($_POST['masuk'])) {
    // Periksa apakah file sudah ada
    if (file_exists($file)) {
        $alert = "<div class='alert alert-success'>Anda berhasil masuk</div>";
        $_SESSION['nim'] = $nim;
        $_SESSION['nama'] = $nama;
        echo "<meta http-equiv='refresh' content='2; url=index.php'>";
    } else {
        $alert = "<div class='alert alert-danger'>Anda gagal masuk</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bs/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
        body {
            background: url('hihi.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
<body>
    
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-4">
            <div class="card mt-5">
                <div class="card-body py-5">
                <center><img src="LOGOO.png" width="300" height="200"></center>

                    <?php echo @$alert ?>
                    <!-- form login -->
                    <div class="card-body py-5">
                        <form action="" method="POST">
                            <input type="number" name="nim" class="form-control mb-4" placeholder="NIM" required>
                            <input type="text" name="nama" class="form-control mb-4" placeholder="Nama Lengkap" required>
                            <div class="form-inline btn-a">
                                <button class="btn btn-primary" name="pengguna_baru">Murid baru</button>
                                <button class="btn btn-primary btn-b" name="masuk">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="jquery/jquery.js"></script>
<script src="bs/js/bootstrap.js"></script>
</body>
</html>
