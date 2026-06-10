<?php
//menyimpan server, username, password, dan Databse pada variabel
$host = "localhost";
$username = "root";
$password = "";
$database = "db_aspmb";

//membuat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $database);

//informasi terkait koneksi
if(!$koneksi){
    die("Koneksi Gagal : " . mysqli_connect_error());
}

echo "Koneksi Berhasil";

?>