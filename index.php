<?php 
//set session
session_start();

if(!isset($_SESSION['login'])){
    header("location: ../login.php");
}else if($_SESSION['login'] && $_SESSION['peran'] != 'pelamar'){
    echo "<script>
        alert('Anda tidak diijinkan mengakses halaman ini');
        document.location.href = '../panitia/index.php';
        </script>";
    }

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelamar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Mengubah background body menjadi biru sangat gelap sesuai gambar */
            background-color: #0b1a30; 
            color: #ffffff;
        }
        /* Tema Navy yang disesuaikan dengan gambar */
        .bg-navy {
            background-color: #06101e !important; /* Warna navbar lebih gelap */
        }
        .text-navy {
            color: #ffffff !important; /* Mengubah teks utama menjadi putih agar kontras */
        }
        /* Navbar Styling */
        .navbar {
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .nav-link {
            color: #a8b2d1 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.6rem 1.2rem !important;
            border-radius: 6px;
        }
        .nav-link:hover, .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .nav-link.text-danger-custom {
            color: #ff6b6b !important;
        }
        .nav-link.text-danger-custom:hover {
            background-color: rgba(220, 53, 69, 0.2);
            color: #ff4747 !important;
        }
        /* Card Styling disesuaikan dengan gambar (biru dongker/komponen gelap) */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            background-color: #112240 !important; /* Latar belakang card biru gelap */
        }
        .text-muted-custom {
            color: #8892b0 !important; /* Warna teks sekunder yang soft untuk mode gelap */
        }
        /* Garis pembatas disesuaikan untuk dark mode */
        .border-bottom-dark {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-navy sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="#">ASPMB</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrasi.php">Registrasi</a>
                </li>
                <li class="nav-item">
            <a class="nav-link" href="kelulusan.php">Kelulusan</a>
        </li>
                <li class="nav-item ms-lg-2">
                    <a class="nav-link text-danger-custom" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container my-5">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pb-3 mb-4 border-bottom-dark">
        <h1 class="h2 fw-bold text-navy mb-0">DASHBOARD PELAMAR</h1>
        <div class="fs-5 text-muted-custom">
            <?php 
                echo "Selamat Datang, <span class='fw-semibold text-info'>" . htmlspecialchars($_SESSION['username'] ?? 'nidia') . "!</span>";
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card p-5">
                
                <h3 class="fw-bold mb-3 text-white text-center">Halo, Selamat Datang para siswa/siswi!</h3>
                
                <p class="text-muted-custom fs-5 mb-0 text-center">
                    Silahkan lengkapi data registrasi dan unggah dokumen Anda melalui menu navigasi di atas untuk melanjutkan ke tahap seleksi berikutnya.
                </p>
                
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>