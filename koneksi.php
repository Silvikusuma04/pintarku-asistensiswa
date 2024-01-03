<?php
$server = "localhost";
$username ="root";
$password="";
$database_name ="pintar";

$koneksi = mysqli_connect($server,$username,$password,$database_name);

if ($koneksi){
echo "berhasil";
}else{
    echo "gagal";
}

?>