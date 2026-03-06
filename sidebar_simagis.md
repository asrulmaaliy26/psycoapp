# Struktur Sidebar / Navigasi Menu SIMAGIS

Dokumen ini mencatat secara lengkap isi **menu navigasi (navbar/sidebar)** dari setiap role pengguna yang ada di aplikasi **SIMAGIS** (Sistem Informasi Manajemen Program Pascasarjana). Terdapat **2 role utama** yang memiliki akses login ke dalam sistem: **Mahasiswa S2** dan **Admin BAK S2**. Dosen _tidak memiliki akses login langsung_ di SIMAGIS.

---

## 1. 🎓 Navigasi Mahasiswa S2

> **Login melalui**: `index.php` → `logUser.php`  
> **Sumber data identitas**: Tabel `mag_dt_mhssw_pasca` (field: `nama`, `nim`)  
> **Halaman pertama**: `dashboardUser.php`

| No  | Menu Utama           | Sub-menu                                | File Tujuan            |
| --- | -------------------- | --------------------------------------- | ---------------------- |
| 1   | **Biodata**          | _(Halaman Utama/Profil)_                | `dashboardUser.php`    |
| 2   | **Permohonan Surat** | Izin Observasi dan Wawancara Matakuliah | `formSowam.php`        |
|     |                      | Izin Penelitian Tesis                   | `formSipt.php`         |
| 3   | **Pengajuan**        | Peminatan Rumpun Psikologi              | `formPengajuanPrp.php` |
|     |                      | Academic Coach                          | `formPengajuanAc.php`  |
|     |                      | Pembimbing Tesis                        | `formPengajuanPt.php`  |
| 4   | **Pendaftaran**      | Seminar Proposal                        | `formPendSempro.php`   |
|     |                      | Ujian Tesis                             | `formPendUjTes.php`    |
|     |                      | _(Separator)_                           | —                      |
|     |                      | Upload Revisi Seminar Proposal          | `formRevisiSempro.php` |
|     |                      | Upload Revisi Ujian Tesis               | `formRevisiTesis.php`  |
| 5   | **Bank**             | Berkas                                  | `downloadUser.php`     |
|     |                      | Judul Tesis                             | `judulTesisUser.php`   |
|     |                      | Variabel Tesis                          | `variabelxyUser.php`   |
| 6   | **Kontak**           | _(Halaman Kontak Layanan BAK)_          | `kontakUser.php`       |
| —   | **Logout**           | —                                       | `logout.php`           |

---

## 2. 🛡️ Navigasi Admin BAK S2

> **Login melalui**: `admin.php` → `logAdm.php`  
> **Sumber data identitas**: Tabel `mag_dt_admin_bak` (field: `username`, `nama`)  
> **Halaman pertama**: `dashboardAdm.php`

| No  | Menu Utama      | Sub-menu                             | File Tujuan              |
| --- | --------------- | ------------------------------------ | ------------------------ |
| 1   | **Dashboard**   | _(Halaman Utama Admin)_              | `dashboardAdm.php`       |
| 2   | **Pengajuan**   | Peminatan Rumpun Psikologi           | `rekapPprpAdm.php`       |
|     |                 | Academic Coach                       | `rekapPacAdm.php`        |
|     |                 | Pembimbing Tesis                     | `rekapPptAdm.php`        |
|     |                 | _(Separator)_                        | —                        |
|     |                 | Surat Izin Observasi dan Wawancara   | `rekapSiowAdm.php`       |
|     |                 | Surat Izin Penelitian Tesis          | `rekapPsiptAdm.php`      |
| 3   | **Pendaftaran** | Seminar Proposal                     | `rekapPendSemproAdm.php` |
|     |                 | Ujian Tesis                          | `rekapPendUjtesAdm.php`  |
|     |                 | Revisi Seminar Proposal              | `rekapRevisiProAdm.php`  |
|     |                 | Revisi Tesis                         | `rekapRevisiTesAdm.php`  |
| 4   | **Master Data** | Dosen                                | `rekapDosenAdm.php`      |
|     |                 | Mahasiswa                            | `rekapMhsswAdm.php`      |
|     |                 | Kontak Layanan                       | `kontakLayananAdm.php`   |
|     |                 | _(Separator)_                        | —                        |
|     |                 | Judul Proposal                       | `rekapJudulPropAdm.php`  |
|     |                 | Judul Tesis                          | `rekapJudulTesisAdm.php` |
|     |                 | Bank Variabel                        | `variabelxyAdm.php`      |
| 5   | **SOP**         | Pengajuan Peminatan Rumpun Psikologi | `sopPprp.php`            |
|     |                 | Pengajuan Academic Coach             | `sopPac.php`             |
|     |                 | Pengajuan Pembimbing Tesis           | `sopPpt.php`             |
|     |                 | _(Separator)_                        | —                        |
|     |                 | Pendaftaran Sempro                   | `sopPspt.php`            |
|     |                 | Pendaftaran Ujian Tesis              | `sopPut.php`             |
| 6   | **Upload**      | Berkas                               | `rekapUpload.php`        |
|     |                 | Pengumuman                           | `rekapPengumuman.php`    |
| —   | **Logout**      | —                                    | `logoutAdm.php`          |

---

## 3. 👨‍🏫 Navigasi Dosen (Catatan Khusus)

> ⚠️ **Dosen tidak memiliki akses login mandiri di SIMAGIS.**  
> Sistem SIMAGIS hanya menyediakan 2 jalur otentikasi: **Mahasiswa** dan **Admin BAK S2**.

Dosen Magister di SIMAGIS berposisi sebagai **entitas yang dikelola** (bukan pengguna aktif). Berikut keterlibatan Dosen secara fungsional yang _tercatat dalam sistem oleh Admin BAK_:

| Fungsi Dosen di Sistem              | Dikelola Oleh                       | File / Halaman Admin                                      |
| ----------------------------------- | ----------------------------------- | --------------------------------------------------------- |
| Data profil & kepakaran Dosen       | Admin BAK                           | `rekapDosenAdm.php`                                       |
| Dosen Wali / Academic Coach         | Admin BAK                           | `rekapPacAdm.php`, `verifikasiPengajuanAc.php`            |
| Dosen Pembimbing Tesis              | Admin BAK                           | `rekapPptAdm.php`, `verifikasiEditPpt.php`                |
| Penuji Sempro (Ketua & Anggota)     | Admin BAK                           | `rekapPendSemproAdm.php`, `cekKehadiranPengujiSempro.php` |
| Penguji Ujian Tesis                 | Admin BAK                           | `rekapPendUjtesAdm.php`, `cekKehadiranPengujiUjtes.php`   |
| Input Nilai Sempro                  | Admin BAK (dari borang fisik Dosen) | `formPenilaianSemproPerPeriode.php`                       |
| Input Nilai Ujian Tesis             | Admin BAK (dari borang fisik Dosen) | `formPenilaianUjtesPerPeriode.php`                        |
| Validasi Revisi Sempro Mahasiswa    | Admin BAK                           | `updateValidasiRevisiPro.php`                             |
| Validasi Revisi Tesis Mahasiswa     | Admin BAK                           | `updateValidasiRevisiTes.php`                             |
| Cetak Berita Acara (Dosen menerima) | Admin BAK                           | `cetakBaSempro.php`, `cetakBaUjtes.php`                   |

---

## Ringkasan Perbandingan Antar Role

| Fitur / Menu                       | Mahasiswa S2 |      Admin BAK S2      |   Dosen    |
| ---------------------------------- | :----------: | :--------------------: | :--------: |
| Login Mandiri                      |      ✅      |           ✅           |     ❌     |
| Buat Permohonan Surat              |      ✅      |           ❌           |     ❌     |
| Validasi & Terbitkan Surat         |      ❌      |           ✅           |     ❌     |
| Ajukan Pengajuan (AC/PPT/Rumpun)   |      ✅      |           ❌           |     ❌     |
| Verifikasi Pengajuan               |      ❌      |           ✅           | ❌ (fisik) |
| Daftar Seminar & Ujian             |      ✅      |           ❌           |     ❌     |
| Penjadwalan Ujian                  |      ❌      |           ✅           |     ❌     |
| Upload Revisi                      |      ✅      |           ❌           |     ❌     |
| Input Nilai Ujian                  |      ❌      | ✅ (manual dari dosen) |     ❌     |
| Kelola Master Data (Dosen/Mhs)     |      ❌      |           ✅           |     ❌     |
| Kelola SOP                         |      ❌      |           ✅           |     ❌     |
| Upload Berkas & Pengumuman         |      ❌      |           ✅           |     ❌     |
| Akses Bank (Berkas/Variabel/Judul) |      ✅      |           ✅           |     ❌     |
