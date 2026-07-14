<?php 
//set session
session_start();
require "../fungsi.php";

if(!isset($_SESSION['login'])){
    header("location: ../login.php");
}else if($_SESSION['login'] && $_SESSION['peran'] != 'pelamar'){
    echo "
    <script>
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
    <title>Registrasi Siswa Baru</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* Navbar Kustom warna Navy */
        .bg-navy {
            background-color: #0d233a !important;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .nav-link:hover {
            color: #ffc107 !important; /* Warna kuning emas saat hover */
        }
        .nav-link.active {
            font-weight: bold;
            border-bottom: 2px solid #ffc107;
        }
        /* Card & Form Styling */
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        .form-legend {
            font-size: 1.2rem;
            font-weight: 600;
            color: #0d233a;
            border-bottom: 2px solid #0d233a;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- NAV BAR (Horizontal, Navy Background) -->
    <nav class="navbar navbar-expand-lg bg-navy navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">registrasi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Registrasi</a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-danger btn-sm px-3 text-white" href="registrasi.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT CONTAINER -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <!-- Welcome Message & Header -->
                <div class="mb-4 text-center text-lg-start">
                    <h1 class="fw-bold text-dark mb-1">Formulir Pendaftaran Siswa Baru</h1>
                    <p class="text-muted">
                        Selamat Datang, <strong class="text-primary"><?= htmlspecialchars($_SESSION['username']); ?></strong>! Silakan lengkapi atau perbarui biodata Anda di bawah ini.
                    </p>
                </div>

                <div class="card card-custom bg-white p-4 p-md-5">
                    <?php 
                    $username = $_SESSION['username'];
                    $dtPendaftar = tampilPendaftar($username);
                    foreach($dtPendaftar as $pendaftar): 
                    ?>
                    <form action="" method="POST">
                        <input type="hidden" name="username" value="<?= $username; ?>">
                        
                        <!-- SEKSI 1: BIODATA CALON SISWA -->
                        <div class="mb-5">
                            <h2 class="form-legend">Biodata Calon Siswa</h2>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="namaDepan" class="form-label fw-semibold">Nama Depan</label>
                                    <input type="text" class="form-control" name="namaDepan" id="namaDepan" value="<?= htmlspecialchars($pendaftar['namaDepan']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="namaBelakang" class="form-label fw-semibold">Nama Belakang</label>
                                    <input type="text" class="form-control" name="namaBelakang" id="namaBelakang" value="<?= htmlspecialchars($pendaftar['namaBelakang']); ?>">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="tempatLahir" class="form-label fw-semibold">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempatLahir" id="tempatLahir" value="<?= htmlspecialchars($pendaftar['tempatLahir']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="tglLahir" class="form-label fw-semibold">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tglLahir" id="tglLahir" value="<?= $pendaftar['tglLahir']; ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label d-block fw-semibold">Jenis Kelamin</label>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="jenisKelamin" id="Laki-laki" value="Laki-laki" <?= $pendaftar['jeniskelamin'] == 'Laki-laki' ? 'checked': ''; ?>>
                                        <label class="form-check-label" for="Laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="jenisKelamin" id="Perempuan" value="Perempuan" <?= $pendaftar['jeniskelamin'] == 'Perempuan' ? 'checked': ''; ?>>
                                        <label class="form-check-label" for="Perempuan">Perempuan</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="nisn" class="form-label fw-semibold">NISN</label>
                                    <input type="text" class="form-control" name="nisn" id="nisn" maxlength="10" value="<?= htmlspecialchars($pendaftar['nisn']); ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="agama" class="form-label fw-semibold">Agama</label>
                                    <select class="form-select" name="agama" id="agama" required>
                                        <option value="">Pilih salah Satu</option>
                                        <option value="Islam" <?= $pendaftar['agama'] == 'Islam' ? 'selected': ''; ?>>Islam</option>
                                        <option value="Hindu"<?= $pendaftar['agama'] == 'Hindu' ? 'selected': ''; ?>>Hindu</option>
                                        <option value="Protestan" <?= $pendaftar['agama'] == 'Protestan' ? 'selected': ''; ?>>Protestan</option>
                                        <option value="Katholik" <?= $pendaftar['agama'] == 'Katholik' ? 'selected': ''; ?>>Katholik</option>
                                        <option value="Budha" <?= $pendaftar['agama'] == 'Budha' ? 'selected': ''; ?>>Budha</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="asalSekolah" class="form-label fw-semibold">Asal Sekolah</label>
                                    <input type="text" class="form-control" name="sekolahAsal" id="asalSekolah" value="<?= htmlspecialchars($pendaftar['sekolahAsal']); ?>" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="telpon" class="form-label fw-semibold">No. Telepon / WA</label>
                                    <input type="text" class="form-control" name="telpon" id="telpon" value="<?= htmlspecialchars($pendaftar['telpon']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" id="alamat" rows="2" required><?= htmlspecialchars($pendaftar['alamat']); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- SEKSI 2: DATA ORANG TUA -->
                        <div class="mb-4">
                            <h2 class="form-legend">Data Orang Tua</h2>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="namaAyah" class="form-label fw-semibold">Nama Ayah</label>
                                    <input type="text" class="form-control" name="namaAyah" id="namaAyah" value="<?= htmlspecialchars($pendaftar['namaAyah']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="pekerjaanAyah" class="form-label fw-semibold">Pekerjaan Ayah</label>
                                    <input type="text" class="form-control" name="pekerjaanAyah" id="pekerjaanAyah" value="<?= htmlspecialchars($pendaftar['pekerjaanAyah']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="penghasilanAyah" class="form-label fw-semibold">Penghasilan Ayah (Rp)</label>
                                    <input type="number" class="form-control" name="penghasilanAyah" id="penghasilanAyah" value="<?= htmlspecialchars($pendaftar['penghasilanAyah']); ?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="namaIbu" class="form-label fw-semibold">Nama Ibu</label>
                                    <input type="text" class="form-control" name="namaIbu" id="namaIbu" value="<?= htmlspecialchars($pendaftar['namaIbu']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="pekerjaanIbu" class="form-label fw-semibold">Pekerjaan Ibu</label>
                                    <input type="text" class="form-control" name="pekerjaanIbu" id="pekerjaanIbu" value="<?= htmlspecialchars($pendaftar['pekerjaanIbu']); ?>">
                                </div>
                                <div class="col-md-4">
                                    <label for="penghasilanIbu" class="form-label fw-semibold">Penghasilan Ibu (Rp)</label>
                                    <input type="number" class="form-control" name="penghasilanIbu" id="penghasilanIbu" value="<?= htmlspecialchars($pendaftar['penghasilanIbu']); ?>">
                                </div>
                            </div>
                        </div>

                        <!-- BUTTONS -->
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <button type="button" class="btn btn-secondary px-4" onclick="history.back()">Batal</button>
                            <button type="submit" name="editregistrasi" class="btn btn-success px-4">Edit Data</button>
                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>

                <!-- PHP Logic Notification -->
                <?php 
                if(isset($_POST['tbl_registrasi'])){ 
                    if(registrasi($_POST) == 1){ 
                        echo "
                        <script> 
                            alert('Anda Berhasil Mendaftar'); 
                            document.location.href = 'registrasi.php'; 
                        </script>"; 
                    }else{ 
                        echo "
                        <script> 
                            alert('Error!!! Anda Gagal Mendaftar'); 
                        </script>"; 
                    } 
                } 
                ?>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>