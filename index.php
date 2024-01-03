<?php
session_start();

// Check if 'nim' and 'nama' are set in the session
if (isset($_SESSION['nim']) && isset($_SESSION['nama'])) {
    $nim = $_SESSION['nim'];
    $nama = $_SESSION['nama'];

    $page = @$_GET['page'];

    // ... rest of your code ...
} else {
    header("location:login.php");
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
    <link rel="stylesheet" href="data_table/datatable.css">
    <style>
        body {
            background: url('hihi.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>
<body>
    

<div class="container">
    <div class="row">
        <div class="col-lg-3 mt-5">
            <?php include"navigasi.php"; ?>
        </div>

        <div class="col-lg-9 mt-5">
            <?php
                if ($page=='asistenAI') {
                    include"asistenAI.php";
                }
                if ($page=='jadwal') {
                    include"jadwal.php";
                }
                elseif($page=='home'||empty($page)){
                    include 'home.php';
                }
                elseif($page=='catatan'){
                    include'catatan.php';
                }
                elseif($page=='contact'){
                    include'contact.php';
                }
                elseif($page=='tugas'){
                    include'tugas.php';
                }
                elseif($page=='logout'){
                    unset($_SESSION['nim']);
                    unset($_SESSION['nama']);
                    header("location:login.php");
    exit();
                }
            ?>
        </div>
    </div>
</div>


<script src="jquery/jquery.js"></script>
<script src="bs/js/bootstrap.js"></script>
<script src="data_table/jquery.datatable.js"></script>
<script src="data_table/datatable.bootstrap.js"></script>
<script src="data_table/main.js"></script>
</body>
</html>