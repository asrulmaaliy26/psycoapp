<?php include("contentsConAdm.php");
// Guard: login normal Mahasiswa S2 ATAU Super Admin yang sedang switch ke role S2
if (empty($_SESSION['nim_s2']) && empty($_SESSION['is_superadmin'])) {
    header("location:../simagis/index.php");
    exit;
}
$nim = $_SESSION['nim_s2'];
// Ambil data mahasiswa S2 dari DB Simagis
// (menggunakan koneksi simagis yang ada di contentsConAdm atau buat sendiri)
$myquery = "SELECT * FROM mag_dt_mhssw_pasca WHERE nim='$nim'";
$result  = mysqli_query($con, $myquery);
$mhs     = mysqli_fetch_assoc($result);
?>
<aside <?php include("main-sidebar-style.php") ?>>
    <?php include("brandNavAdm.php"); ?>
    <div class="sidebar text-sm">
        <!-- Info Mahasiswa S2 -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="images/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="dashboardUserS2.php" class="d-block text-truncate" style="max-width:150px;">
                    <?php echo htmlspecialchars($mhs['nama'] ?? '-'); ?>
                </a>
                <small class="text-muted"><?php echo htmlspecialchars($nim); ?> | S2</small>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact"
                data-widget="treeview" role="menu" data-accordion="false">

                <!-- 1. Biodata / Dashboard Utama -->
                <li class="nav-item">
                    <a href="dashboardUserS2.php" class="nav-link">
                        <i class="nav-icon fas fa-house-user"></i>
                        <p>Biodata</p>
                    </a>
                </li>

                <!-- 2. Permohonan Surat -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>Permohonan Surat <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../simagis/formSowam.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Izin Observasi &amp; Wawancara</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/formSipt.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Izin Penelitian Tesis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 3. Pengajuan -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-people-arrows"></i>
                        <p>Pengajuan <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../simagis/formPengajuanPrp.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peminatan Rumpun Psikologi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/formPengajuanAc.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Academic Coach</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/formPengajuanPt.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembimbing Tesis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 4. Pendaftaran -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Pendaftaran <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../simagis/formPendSempro.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Seminar Proposal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/formPendUjTes.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ujian Tesis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/formRevisiSempro.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Revisi Seminar Proposal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/formRevisiTesis.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Revisi Ujian Tesis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 5. Bank -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>Bank <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../simagis/downloadUser.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Berkas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/judulTesisUser.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Judul Tesis</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../simagis/variabelxyUser.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Variabel Tesis</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 6. Kontak -->
                <li class="nav-item">
                    <a href="../simagis/kontakUser.php" class="nav-link">
                        <i class="nav-icon fas fa-phone-alt"></i>
                        <p>Kontak</p>
                    </a>
                </li>

                <!-- Logout / Kembali SA -->
                <li class="nav-item mt-3">
                    <?php if (!empty($_SESSION['is_superadmin'])): ?>
                        <a href="superAdminDashboard.php" class="nav-link text-warning">
                            <i class="nav-icon fas fa-arrow-left"></i>
                            <p>Kembali ke Super Admin</p>
                        </a>
                    <?php else: ?>
                        <a href="../simagis/logout.php" class="nav-link text-danger">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    <?php endif; ?>
                </li>

            </ul>
        </nav>
    </div>
</aside>