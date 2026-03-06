<?php include("contentsConAdm.php");
// Guard: login normal Mahasiswa S2 ATAU Super Admin yang switch ke role S2
if (empty($_SESSION['nim_s2']) && empty($_SESSION['is_superadmin'])) {
    header("location:../simagis/index.php");
    exit;
}
$nim = $_SESSION['nim_s2'];

// Ambil data dari database (sambungkan ke DB yang sama dgn SIMAGIS via $con)
$qmhs    = "SELECT * FROM mag_dt_mhssw_pasca WHERE nim='$nim'";
$rmhs    = mysqli_query($con, $qmhs);
$mhs     = mysqli_fetch_assoc($rmhs);

// --- Hitung ringkasan data untuk widget dashboard ---
// Permohonan Surat
$q_siow = "SELECT COUNT(id) AS tot FROM mag_siowi WHERE nim='$nim'";
$siow   = mysqli_fetch_assoc(mysqli_query($con, $q_siow))['tot'] ?? 0;

$q_sipt = "SELECT COUNT(id) AS tot FROM mag_sipt WHERE nim='$nim'";
$sipt   = mysqli_fetch_assoc(mysqli_query($con, $q_sipt))['tot'] ?? 0;

// Pengajuan
$q_pprp = "SELECT COUNT(id) AS tot FROM mag_pengelompokan_rumpun WHERE nim='$nim'";
$pprp   = mysqli_fetch_assoc(mysqli_query($con, $q_pprp))['tot'] ?? 0;

$q_pac  = "SELECT COUNT(id) AS tot FROM mag_pengelompokan_dosen_wali WHERE nim='$nim'";
$pac    = mysqli_fetch_assoc(mysqli_query($con, $q_pac))['tot'] ?? 0;

$q_ppt  = "SELECT COUNT(id) AS tot FROM mag_pengelompokan_dospem_tesis WHERE nim='$nim'";
$ppt    = mysqli_fetch_assoc(mysqli_query($con, $q_ppt))['tot'] ?? 0;

// Pendaftaran
$q_sempro = "SELECT COUNT(id) AS tot FROM mag_peserta_sempro WHERE nim='$nim'";
$sempro   = mysqli_fetch_assoc(mysqli_query($con, $q_sempro))['tot'] ?? 0;

$q_ujtes  = "SELECT COUNT(id) AS tot FROM mag_peserta_ujtes WHERE nim='$nim'";
$ujtes    = mysqli_fetch_assoc(mysqli_query($con, $q_ujtes))['tot'] ?? 0;

$q_revsempro = "SELECT COUNT(id) AS tot FROM mag_revisi_sempro WHERE nim='$nim'";
$revsempro   = mysqli_fetch_assoc(mysqli_query($con, $q_revsempro))['tot'] ?? 0;

$q_revtesis  = "SELECT COUNT(id) AS tot FROM mag_revisi_tesis WHERE nim='$nim'";
$revtesis    = mysqli_fetch_assoc(mysqli_query($con, $q_revtesis))['tot'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<?php include("headAdm.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php
        include("navtopAdm.php");
        include("navSideBarUserS2.php");
        ?>
        <div class="content-wrapper">
            <!-- Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard Mahasiswa S2</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Selamat datang, <strong><?php echo htmlspecialchars($mhs['nama'] ?? $_SESSION['nama_s2'] ?? '-'); ?></strong></li>
                                <?php if (!empty($_SESSION['is_superadmin'])): ?>
                                    <li class="breadcrumb-item">
                                        <a href="superAdminDashboard.php" class="badge badge-warning" title="Kembali ke Super Admin Panel">
                                            <i class="fas fa-bolt"></i> Mode SA
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">

                    <!-- ===== Info Cards ===== -->
                    <div class="row mb-3">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $siow + $sipt; ?></h3>
                                    <p>Permohonan Surat</p>
                                </div>
                                <div class="icon"><i class="fas fa-envelope-open-text"></i></div>
                                <a href="../simagis/formSipt.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $pprp + $pac + $ppt; ?></h3>
                                    <p>Pengajuan (Rumpun/AC/PPT)</p>
                                </div>
                                <div class="icon"><i class="fas fa-people-arrows"></i></div>
                                <a href="../simagis/formPengajuanPrp.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $sempro + $ujtes; ?></h3>
                                    <p>Pendaftaran Ujian</p>
                                </div>
                                <div class="icon"><i class="fas fa-file-alt"></i></div>
                                <a href="../simagis/formPendSempro.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php echo $revsempro + $revtesis; ?></h3>
                                    <p>Upload Revisi</p>
                                </div>
                                <div class="icon"><i class="fas fa-upload"></i></div>
                                <a href="../simagis/formRevisiSempro.php" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- ===== Tabel Permohonan Surat ===== -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-envelope-open-text mr-1"></i> Permohonan Surat</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-sm m-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="text-left">Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="text-left">Izin Observasi &amp; Wawancara</td>
                                                <td><?php echo $siow; ?></td>
                                                <td>
                                                    <?php if ($siow > 0) echo '<a href="../simagis/rekapPsiptAdm.php" class="btn btn-outline-info btn-xs">Riwayat</a>';
                                                    else echo '<a href="../simagis/formSowam.php" class="btn btn-outline-success btn-xs">Ajukan</a>'; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="text-left">Izin Penelitian Tesis (SIPT)</td>
                                                <td><?php echo $sipt; ?></td>
                                                <td>
                                                    <?php if ($sipt > 0) echo '<a href="../simagis/rekapPsiptAdm.php" class="btn btn-outline-info btn-xs">Riwayat</a>';
                                                    else echo '<a href="../simagis/formSipt.php" class="btn btn-outline-success btn-xs">Ajukan</a>'; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- ===== Tabel Pengajuan ===== -->
                        <div class="col-md-6">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-people-arrows mr-1"></i> Pengajuan</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-sm m-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="text-left">Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="text-left">Peminatan Rumpun Psikologi</td>
                                                <td><?php echo $pprp; ?></td>
                                                <td><a href="../simagis/formPengajuanPrp.php" class="btn btn-outline-primary btn-xs">Form</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="text-left">Academic Coach</td>
                                                <td><?php echo $pac; ?></td>
                                                <td><a href="../simagis/formPengajuanAc.php" class="btn btn-outline-primary btn-xs">Form</a></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td class="text-left">Pembimbing Tesis</td>
                                                <td><?php echo $ppt; ?></td>
                                                <td><a href="../simagis/formPengajuanPt.php" class="btn btn-outline-primary btn-xs">Form</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== Tabel Pendaftaran ===== -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-warning card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-file-alt mr-1"></i> Pendaftaran Ujian</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-sm m-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="text-left">Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="text-left">Seminar Proposal</td>
                                                <td><?php echo $sempro; ?></td>
                                                <td><a href="../simagis/formPendSempro.php" class="btn btn-outline-warning btn-xs">Form</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="text-left">Ujian Tesis</td>
                                                <td><?php echo $ujtes; ?></td>
                                                <td><a href="../simagis/formPendUjTes.php" class="btn btn-outline-warning btn-xs">Form</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- ===== Tabel Upload Revisi ===== -->
                        <div class="col-md-6">
                            <div class="card card-danger card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-upload mr-1"></i> Upload Revisi</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-hover table-sm m-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="text-left">Jenis</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td class="text-left">Revisi Seminar Proposal</td>
                                                <td><?php echo $revsempro; ?></td>
                                                <td><a href="../simagis/formRevisiSempro.php" class="btn btn-outline-danger btn-xs">Form</a></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td class="text-left">Revisi Ujian Tesis</td>
                                                <td><?php echo $revtesis; ?></td>
                                                <td><a href="../simagis/formRevisiTesis.php" class="btn btn-outline-danger btn-xs">Form</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===== Bank Referensi ===== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-database mr-1"></i> Bank Referensi S2</h3>
                                </div>
                                <div class="card-body">
                                    <a href="../simagis/downloadUser.php" class="btn btn-outline-secondary mr-2 mb-2">
                                        <i class="fas fa-download"></i> Berkas &amp; Panduan
                                    </a>
                                    <a href="../simagis/judulTesisUser.php" class="btn btn-outline-secondary mr-2 mb-2">
                                        <i class="fas fa-book-open"></i> Bank Judul Tesis
                                    </a>
                                    <a href="../simagis/variabelxyUser.php" class="btn btn-outline-secondary mr-2 mb-2">
                                        <i class="fas fa-project-diagram"></i> Bank Variabel Tesis
                                    </a>
                                    <a href="../simagis/kontakUser.php" class="btn btn-outline-info mb-2">
                                        <i class="fas fa-phone-alt"></i> Kontak Layanan BAK
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
    <?php include("footerAdm.php"); ?>
    <?php include("jsAdm.php"); ?>
</body>

</html>