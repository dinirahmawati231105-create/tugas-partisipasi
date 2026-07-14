<?php

    session_start();

    require "../fungsi.php";

    if(!isset($_SESSION['login'])){
        header("Location: ../login.php");
        exit;
    }

    if($_SESSION['peran'] != "pelamar"){
        header("Location: ../login.php");
        exit;
    }

    if(isset($_POST['registrasi'])){

    $hasil = registrasi($_POST);

    if($hasil > 0){
        echo "<script>
        alert('Data berhasil disimpan');
        document.location.href='registrasi.php';
        </script>";
    }else{
        echo "<script>alert('Data gagal disimpan');</script>";
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelamar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            background-color: #0b192c; 
            color: #ffffff;
        }
        .navbar {
            background-color: #08101e !important; 
        }
        .form-card {
            background-color: #112240; 
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
        .nav-tabs-custom {
            background-color: #112240;
            border-radius: 8px;
            padding: 10px;
        }
        .nav-tabs-custom .nav-link {
            color: #f8faff;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            transition: all 0.3s;
        }
        .nav-tabs-custom .nav-link.active {
            background-color: #233554 !important;
            color: #ffffff !important;
        }
        .nav-tabs-custom .nav-link:hover:not(.active) {
            color: #ffffff;
            background-color: rgba(255,255,255,0.05);
        }
        .form-control, .form-select {
            background-color: #f8fbff !important; /* Putih keabuan seperti di gambar */
            color: #112240 !important;
            border: 1px solid #fafcff;
        }
        .form-check-input:checked {
            background-color: #233554;
            border-color: #233554;
        }
    </style>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">ASPMB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">DASHBOARD REGISTRASI</h2>
            <p class="text-white mb-0">Silahkan isi biodata anda dengan benar</p>
        </div>
        <div class="fs-5">
            Selamat Datang, <span class="text-info fw-bold"><?php echo $_SESSION['username']; ?></span>!
        </div>
    </div>

    <ul class="nav nav-pills nav-justified nav-tabs-custom mb-4 shadow-sm">
        <li class="nav-item">
            <a class="nav-link active" href="#">Registrasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="dokumen.php">Dokumen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="kelulusan.php">Kelulusan</a>
        </li>
    </ul>

    <div class="form-card mt-4">
        <?php 
            $username = $_SESSION['username'];
            if(cekRegistrasi($username) == 0):
        ?>
        <form action="" method="POST">
    <div class="row g-4">
        
        <div class="col-md-6">
            <label for="namaDepan" class="form-label fw-semibold">Nama Depan</label>
            <input type="text" class="form-control form-control-lg" name="namaDepan" id="namaDepan" required>
        </div>

        <div class="col-md-6">
            <label for="namaBelakang" class="form-label fw-semibold">Nama Belakang</label>
            <input type="text" class="form-control form-control-lg" name="namaBelakang" id="namaBelakang" required>
        </div>

        <div class="col-md-6">
            <label for="tempatLahir" class="form-label fw-semibold">Tempat Lahir</label>
            <input type="text" class="form-control form-control-lg" name="tempatLahir" id="tempatLahir" required>
        </div>

        <div class="col-md-6">
            <label for="tglLahir" class="form-label fw-semibold">Tanggal Lahir</label>
            <input type="date" class="form-control form-control-lg" name="tglLahir" id="tglLahir" required>
        </div>

        <div class="col-md-6">
            <label class="form-label d-block fw-semibold">Jenis Kelamin</label>
            <div class="mt-2">
                <div class="form-check form-check-inline me-4">
                    <input class="form-check-input" type="radio" name="jenisKelamin" id="Laki-laki" value="Laki-laki" required>
                    <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="jenisKelamin" id="Perempuan" value="Perempuan">
                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <label for="nisn" class="form-label fw-semibold">NISN</label>
            <input type="text" class="form-control form-control-lg" name="nisn" id="nisn" maxlength="10" required>
        </div>

        <div class="col-md-6">
            <label for="agama" class="form-label fw-semibold">Agama</label>
            <select class="form-select form-select-lg" name="agama" id="agama">
                <option value="Islam">Islam</option>
                <option value="Hindu">Hindu</option>
                <option value="Protestan">Protestan</option>
                <option value="Katholik">Katholik</option>
                <option value="Budha">Budha</option>
            </select>
        </div>

        <div class="col-md-6">
            <label for="asalSekolah" class="form-label fw-semibold">Asal Sekolah</label>
            <input type="text" class="form-control form-control-lg" name="sekolahAsal" id="asalSekolah" required>
        </div>

        <div class="col-12">
            <label for="alamat" class="form-label fw-semibold">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
        </div>

        <div class="col-md-6">
            <label for="telepon" class="form-label fw-semibold">Telepon/WA</label>
            <input type="text" class="form-control form-control-lg" name="telepon" id="telepon" required>
        </div>


        <div class="col-12 mt-5">
            <h4 class="fw-bold text-info border-bottom pb-2">Data Orang Tua / Wali</h4>
        </div>

        <div class="col-md-4">
            <label for="namaAyah" class="form-label fw-semibold">Nama Ayah</label>
            <input type="text" class="form-control form-control-lg" name="namaAyah" id="namaAyah" required>
        </div>
        <div class="col-md-4">
            <label for="pekerjaanAyah" class="form-label fw-semibold">Pekerjaan Ayah</label>
            <input type="text" class="form-control form-control-lg" name="pekerjaanAyah" id="pekerjaanAyah" required>
        </div>
        <div class="col-md-4">
            <label for="penghasilanAyah" class="form-label fw-semibold">Penghasilan Ayah (Rp)</label>
            <input type="number" class="form-control form-control-lg" name="penghasilanAyah" id="penghasilanAyah" placeholder="Contoh: 3000000" required>
        </div>

        <div class="col-md-4">
            <label for="namaIbu" class="form-label fw-semibold">Nama Ibu</label>
            <input type="text" class="form-control form-control-lg" name="namaIbu" id="namaIbu" required>
        </div>
        <div class="col-md-4">
            <label for="pekerjaanIbu" class="form-label fw-semibold">Pekerjaan Ibu</label>
            <input type="text" class="form-control form-control-lg" name="pekerjaanIbu" id="pekerjaanIbu" required>
        </div>
        <div class="col-md-4">
            <label for="penghasilanIbu" class="form-label fw-semibold">Penghasilan Ibu (Rp)</label>
            <input type="number" class="form-control form-control-lg" name="penghasilanIbu" id="penghasilanIbu" placeholder="Contoh: 2500000" required>
        </div>

        <div class="col-12 mt-4 text-end">
            <button type="submit" class="btn btn-primary btn-lg px-5" name="registrasi">Submit Data</button>
        </div>
        
    </div>
</form>

<?php 
            else:
                //jika hasil cek registrasi 1 maka tampilkan pesan sudah mengisi formulir
                //selanjutnya pendaftar dapat mengedit formulir
                echo "Anda sudah mengisi formulir, Berikut data yang anda Kirim : <hr> ";             

                //tampilkan data pelamar yang diambil dari tbl_registrasi dan tbl_orangtua

                $dataPendaftar = tampilPendaftar($username);
                //var_dump($dataPendaftar);

                foreach($dataPendaftar as $pendaftar):
            ?>
                <ul>
                    <li>Nama Depan : <?= $pendaftar['namaDepan']; ?></li>
                    <li>Nama Belakang : <?= $pendaftar['namaBelakang']; ?></li>
                    <li>Tempat, Tanggal Lahir : <?= $pendaftar['tempatLahir']; ?>, <?= date('d F Y', strtotime($pendaftar['tglLahir'])); ?></li>
                    <li>Jenis Kelamin : <?= $pendaftar['jeniskelamin']; ?></li>
                    <li>NISN : <?= $pendaftar['nisn']; ?></li>
                    <li>Agama : <?= $pendaftar['agama']; ?></li>
                    <li>Sekolah Asal : <?= $pendaftar['sekolahAsal']; ?></li>
                    <li>alamat : <?= $pendaftar['alamat']; ?></li>
                    <li>Nomor Telpon : <?= $pendaftar['telpon']; ?></li>

                </ul>
                <p> <strong>Data Orang Tua</strong></p>
                <ul>
                    <li>Nama Ayah: <?= $pendaftar['namaAyah']; ?></li>
                    <li>Pekerjaan Ayah: <?= $pendaftar['pekerjaanAyah']; ?></li>
                    <li>Penghasilan Ayah: Rp. <?= $pendaftar['penghasilanAyah']; ?></li>
                    <li>Nama Ibu: <?= $pendaftar['namaIbu']; ?></li>
                    <li>Pekerjaan Ibu: <?= $pendaftar['pekerjaanIbu']; ?></li>
                    <li>Penghasilan Ibu: Rp. <?= $pendaftar['penghasilanIbu']; ?></li>
                </ul>

                <p>Untuk melakukan perubahan klik <a href="edit.php"><strong>Edit</strong></a></p>


            <?php
                endforeach;
                endif;

            
            ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>