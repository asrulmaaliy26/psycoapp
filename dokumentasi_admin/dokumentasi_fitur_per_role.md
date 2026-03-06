# 📚 Dokumentasi Lengkap Fitur Per Role — Sistem Psikologi Apps

Dokumen ini merangkum **semua fitur** dalam sistem berdasarkan **role (peran)** pengguna.  
Sistem terdiri dari dua modul: `psychoApps/` (S1) dan `simagis/` (S2 Magister).

---

## 👥 DAFTAR ROLE / PENGGUNA

| Role                      | Modul         | Login Via           | Deskripsi                            |
| ------------------------- | ------------- | ------------------- | ------------------------------------ |
| **Mahasiswa S1**          | `psychoApps/` | NIM + Password      | Mahasiswa program S1 Psikologi       |
| **Mahasiswa S2**          | `simagis/`    | NIM + Password      | Mahasiswa program Magister Psikologi |
| **Admin BAK S1**          | `psychoApps/` | Username + Password | Biro Administrasi Kemahasiswaan S1   |
| **Admin BAK S2**          | `simagis/`    | Username + Password | Admin pengelola data S2              |
| **Admin BMN**             | `psychoApps/` | Username + Password | Barang Milik Negara                  |
| **Admin Kepegawaian**     | `psychoApps/` | Username + Password | Pengelola data pegawai               |
| **Admin Tata Persuratan** | `psychoApps/` | Username + Password | Pengelola surat keluar/masuk         |
| **Dosen**                 | `psychoApps/` | NIP + Password      | Dosen penguji, pembimbing, pengawas  |

---

## ═══════════════════════════════════

## 🧑‍🎓 ROLE: MAHASISWA S1

**Dashboard:** `dashboardUserS1.php`  
**Navigasi:** `navSideBarUserS1.php`

## ═══════════════════════════════════

### 1. Profil & Biodata

| Fitur                       | File PHP                 | Keterangan                               |
| --------------------------- | ------------------------ | ---------------------------------------- |
| Lihat & edit profil pribadi | `profilPribadiUser.php`  | Nama, tempat/tgl lahir, gender, NIK, dll |
| Edit profil akademik        | `profilAkademikUser.php` | Jurusan, fakultas, asal sekolah, dll     |
| Edit profil orang tua/wali  | `profilOrtuUser.php`     | Nama ayah/ibu, pekerjaan, alamat, kontak |
| Upload/Update foto          | `profilFotoUser.php`     | Foto profil mahasiswa                    |

---

### 2. Pengajuan Dosen Pembimbing Skripsi (Dospem)

| Fitur                                      | File PHP                          | Keterangan                                |
| ------------------------------------------ | --------------------------------- | ----------------------------------------- |
| Form pengajuan (Step 1: judul & peminatan) | `formPengajuanDospemUserSatu.php` | Data dasar pengajuan                      |
| Form pengajuan (Step 2: upload berkas)     | `formPengajuanDospemUserDua.php`  | Proposal, transkrip, TOEFL, tashih, UKT   |
| Form pengajuan (Step 3: pilih dospem)      | `formPengajuanDospemUserTiga.php` | Pilih 2 calon dospem (cek kuota otomatis) |
| Edit pengajuan                             | `editPengajuanDospemUser.php`     | Edit sebelum diverifikasi                 |
| Hapus pengajuan                            | `deletePengajuanDospemUser.php`   | Hapus jika belum diverifikasi             |
| Riwayat & status pengajuan                 | `riwayatPengajuanDospemUser.php`  | Pantau status (cek1/cek2/cekjudul)        |

**Tabel DB:** `pengelompokan_dospem_skripsi`, `pengajuan_dospem`, `dospem_skripsi`

---

### 3. Pendaftaran PKL (Praktik Kerja Lapangan)

| Fitur                               | File PHP                                  | Keterangan                             |
| ----------------------------------- | ----------------------------------------- | -------------------------------------- |
| Form pendaftaran (step 1: data PKL) | `formPendaftaranPklUserSatu.php`          | Nama instansi, lokasi, bidang, periode |
| Upload berkas (step 2)              | `formPendaftaranPklUserDua.php`           | Upload transkrip, proposal PKL         |
| Upload surat keterangan (step 3)    | `formPendaftaranPklUserTiga.php`          | Surat tambahan                         |
| Edit pendaftaran                    | `editPendaftaranPklUserSatu/Dua/Tiga.php` | Edit sebelum diverifikasi              |
| Hapus pendaftaran                   | `deletePendaftaranPklUser.php`            | —                                      |
| Cetak berkas pendaftaran PKL        | `cetakPpklUser.php`                       | Cetak dokumen resmi                    |
| Riwayat & status                    | `riwayatPendaftaranPklUser.php`           | Cek status verifikasi dan nilai        |
| Detail riwayat                      | `detailRiwayatPendaftaranPklUser.php`     | Detail lengkap                         |
| Lihat jadwal PKL                    | `jadwalKompreUser.php`                    | Lihat jadwal yang di-assign admin      |

---

### 4. Pendaftaran Seminar Proposal Skripsi (Sempro)

| Fitur                    | File PHP                                 | Keterangan                           |
| ------------------------ | ---------------------------------------- | ------------------------------------ |
| Form pendaftaran         | `prePendaftaranSemproUser.php`           | Cek syarat otomatis                  |
| Step 1: data sempro      | `formPendaftaranSemproUserSatu.php`      | Judul, data pendaftaran              |
| Step 2: upload proposal  | `formPendaftaranSemproUserDua.php`       | File proposal PDF                    |
| Edit pendaftaran         | `editPendaftaranSemproUserSatu/Dua.php`  | —                                    |
| Hapus pendaftaran        | `deletePendaftaranSemproUser.php`        | —                                    |
| Cetak berkas pendaftaran | `cetakPsemproUser.php`                   | Dokumen pendaftaran untuk diserahkan |
| Lihat jadwal seminar     | `cetakJadwalSemproPerPeriodeUser.php`    | Jadwal + ruang + penguji             |
| Riwayat & hasil          | `riwayatPendaftaranSemproUser.php`       | Nilai + status (lulus/seminar ulang) |
| Detail riwayat           | `detailRiwayatPendaftaranSemproUser.php` | —                                    |
| Cek catatan admin        | `catatanPendaftaranSemproUser.php`       | Catatan jika ditolak                 |

---

### 5. Pendaftaran Ujian Komprehensif (Kompre)

| Fitur                 | File PHP                                 | Keterangan          |
| --------------------- | ---------------------------------------- | ------------------- |
| Form pendaftaran      | `prePendaftaranUjianKompreUser.php`      | Cek syarat otomatis |
| Step 1: data kompre   | `formPendaftaranKompreUserSatu.php`      | —                   |
| Step 2: upload berkas | `formPendaftaranKompreUserDua.php`       | —                   |
| Edit pendaftaran      | `editPendaftaranKompreUserSatu/Dua.php`  | —                   |
| Hapus pendaftaran     | `deletePendaftaranKompreUser.php`        | —                   |
| Cetak berkas          | `cetakPkompreUser.php`                   | —                   |
| Lihat jadwal kompre   | `jadwalKompreUser.php`                   | —                   |
| Riwayat & hasil       | `riwayatPendaftaranUjianKompreUser.php`  | Nilai hasil kompre  |
| Detail riwayat        | `detailRiwayatPendaftaranKompreUser.php` | —                   |

---

### 6. Pendaftaran Ujian Skripsi

| Fitur                    | File PHP                                 | Keterangan            |
| ------------------------ | ---------------------------------------- | --------------------- |
| Form pendaftaran         | `prePendaftaranUjianSkripsiUser.php`     | Cek 6 syarat otomatis |
| Step 1: data ujian       | `formPendaftaranUjskripUserSatu.php`     | Data pendaftaran      |
| Step 2: upload skripsi   | `formPendaftaranUjskripUserDua.php`      | File skripsi PDF      |
| Edit pendaftaran         | `editPendaftaranUjskripUserSatu/Dua.php` | —                     |
| Hapus pendaftaran        | `deletePendaftaranUjskripUser.php`       | —                     |
| Cetak semua berkas ujian | `cetakPujskripUser.php`                  | Cetak lengkap (52KB)  |
| Lihat jadwal ujian       | `cetakJadwalUjskripPerPeriodeUser.php`   | Jadwal + penguji      |
| Riwayat & hasil          | `riwayatPendaftaranUjianSkripsiUser.php` | Nilai akhir skripsi   |
| Cek catatan              | `catatanPendaftaranUjskripUser.php`      | Catatan admin         |

---

### 7. Permohonan Surat

| Fitur                                                | File PHP                             | Keterangan              |
| ---------------------------------------------------- | ------------------------------------ | ----------------------- |
| Dashboard permohonan surat                           | `permohonanSuratUser.php`            | 12 jenis surat tersedia |
| Surat Izin Observasi Individu                        | `formSiowiUser.php`                  | —                       |
| Surat Izin Observasi Kelompok                        | `formSiowkUser.php`                  | —                       |
| Izin Praktikum Individu (Testee mahasiswa)           | `formSiprakimUser.php`               | —                       |
| Izin Praktikum Individu (Testee siswa)               | `formSiprakisUser.php`               | —                       |
| Izin Praktikum Kelompok (Testee mahasiswa)           | `formSiprakkmUser.php`               | —                       |
| Izin Praktikum Kelompok (Testee siswa)               | `formSiprakksUser.php`               | —                       |
| Izin Magang Mandiri Individu                         | `formSimagiUser.php`                 | —                       |
| Izin Magang Mandiri Kelompok                         | `formSimagkUser.php`                 | —                       |
| Izin Tempat PKL                                      | `formSitpUser.php`                   | —                       |
| Izin Observasi Pra Skripsi                           | `formPraSipsUser.php`                | —                       |
| Izin Penelitian Skripsi                              | `formSipsUser.php`                   | —                       |
| Keterangan Kelakuan Baik                             | `formSkkbUser.php`                   | —                       |
| Masing-masing ada: riwayat, edit, hapus, cetak surat | `riwayat*User.php`, `cetak*User.php` | —                       |

---

### 8. SKKM (Satuan Kredit Kegiatan Mahasiswa)

| Fitur        | File PHP              | Keterangan                               |
| ------------ | --------------------- | ---------------------------------------- |
| Isi SKKM     | `formSkkmUser.php`    | Wajib diisi sebelum daftar Ujian Skripsi |
| Edit SKKM    | `editSkkmUser.php`    | —                                        |
| Hapus SKKM   | `deleteSkkmUser.php`  | —                                        |
| Cetak SKKM   | `cetakSkkmUser.php`   | Cetak bukti SKKM                         |
| Riwayat SKKM | `riwayatSkkmUser.php` | —                                        |
| Unsur SKKM   | `unsurSkkmUser.php`   | Jenis kegiatan yang dihitung             |

---

## ═══════════════════════════════════

## 🧑‍🎓 ROLE: MAHASISWA S2 (MAGISTER)

**Dashboard:** `simagis/dashboardUser.php`  
**Navigasi:** `simagis/navPendUser.php`

## ═══════════════════════════════════

### 1. Profil & Biodata S2

| Fitur               | File PHP                  | Keterangan               |
| ------------------- | ------------------------- | ------------------------ |
| Lihat & edit profil | `simagis/udmUser.php`     | Update data mahasiswa S2 |
| Upload foto         | `simagis/udmFotoUser.php` | Foto profil              |

---

### 2. Pengajuan Pembimbing Tesis (PPT)

| Fitur                              | File PHP                            | Keterangan                              |
| ---------------------------------- | ----------------------------------- | --------------------------------------- |
| Form pengajuan PPT lengkap         | `simagis/formPengajuanPt.php`       | Judul, variabel, calon pembimbing 1 & 2 |
| Isi variabel X-Y                   | `simagis/variabelxyUser.php`        | Variabel bebas & tergantung             |
| Isi variabel mediator              | `simagis/variabelmediatorUser.php`  | Variabel mediator jika ada              |
| Isi variabel moderator             | `simagis/variabelmoderatorUser.php` | Variabel moderator jika ada             |
| Isi covariabel                     | `simagis/covariabelUser.php`        | Covariabel jika ada                     |
| Edit pembimbing pilihan satu       | `simagis/editPptSatuUser.php`       | —                                       |
| Edit pembimbing pilihan dua        | `simagis/editPptDuaUser.php`        | —                                       |
| Edit judul & luaran                | `simagis/editJudOutPptUser.php`     | —                                       |
| Lihat detail PPT satu              | `simagis/detailPptSatuUser.php`     | —                                       |
| Lihat detail PPT dua               | `simagis/detailPptDuaUser.php`      | —                                       |
| Judul tesis (setelah dikonfirmasi) | `simagis/judulTesisUser.php`        | —                                       |
| Status semua PPT                   | `simagis/viewListPptUser.php`       | —                                       |

---

### 3. Data Psikologis Diri (Penjurusan/PPRP)

| Fitur                          | File PHP                       | Keterangan                        |
| ------------------------------ | ------------------------------ | --------------------------------- |
| Isi PPRP (Peminatan Psikologi) | `simagis/formPengajuanPrp.php` | Klinik/industri/pendidikan/sosial |
| Edit PPRP                      | `simagis/editPprpUser.php`     | —                                 |

---

### 4. Aktivitas Akademik (AC)

| Fitur             | File PHP                          | Keterangan                  |
| ----------------- | --------------------------------- | --------------------------- |
| Form pengajuan AC | `simagis/formPengajuanAc.php`     | Pengajuan kegiatan akademik |
| Edit AC           | `simagis/editPacUser.php`         | —                           |
| Detail AC         | `simagis/detailAcUser.php`        | —                           |
| Lihat rekap AC    | `simagis/includeRekapPacUser.php` | —                           |

---

### 5. Surat-surat Khusus S2

| Fitur                    | File PHP                                            | Keterangan            |
| ------------------------ | --------------------------------------------------- | --------------------- |
| Izin Penelitian Tesis    | `simagis/formSipt.php`                              | Surat izin penelitian |
| Izin Observasi Wawancara | `simagis/formSowam.php`                             | Surat izin OW         |
| Edit surat SIPT          | `simagis/editSiptUser.php`                          | —                     |
| Edit surat SOWAM         | `simagis/editSowamUser.php`                         | —                     |
| Hapus surat              | `simagis/deleteSiptUser.php`, `deleteSowamUser.php` | —                     |

---

### 6. Pendaftaran Seminar Proposal Tesis

| Fitur                         | File PHP                             | Keterangan                |
| ----------------------------- | ------------------------------------ | ------------------------- |
| Form pendaftaran + cek syarat | `simagis/formPendSempro.php`         | 3 kondisi syarat          |
| Submit form sempro            | `simagis/sformPendSempro.php`        | —                         |
| Edit pendaftaran              | `simagis/editPendSemproUser.php`     | —                         |
| Hapus pendaftaran             | `simagis/deletePendSemproUser.php`   | —                         |
| Detail pendaftaran            | `simagis/detailPendSemproUser.php`   | —                         |
| Cetak pendaftaran             | `simagis/cetakPendSemproUser.php`    | —                         |
| Cetak jadwal                  | `simagis/cetakJadwalSempro.php`      | Setelah dijadwalkan admin |
| Riwayat sempro                | `simagis/includeRekapSemproUser.php` | Nilai + status            |

---

### 7. Upload Revisi Proposal Tesis

| Fitur                       | File PHP                                  | Keterangan             |
| --------------------------- | ----------------------------------------- | ---------------------- |
| Form upload revisi proposal | `simagis/formRevisiSempro.php`            | Upload file revisi PDF |
| Edit revisi                 | `simagis/includeEditFormRevisiSempro.php` | —                      |

---

### 8. Pendaftaran Ujian Tesis

| Fitur                           | File PHP                          | Keterangan                                                  |
| ------------------------------- | --------------------------------- | ----------------------------------------------------------- |
| Form pendaftaran + cek 7 syarat | `simagis/formPendUjTes.php`       | Syarat paling ketat                                         |
| Submit form ujian tesis         | `simagis/sformPendUjtes.php`      | Upload: tesis, kwitansi, transkrip, TOEFL, Turnitin, jurnal |
| Edit pendaftaran                | `simagis/editPendUjtesUser.php`   | —                                                           |
| Hapus pendaftaran               | `simagis/deletePendUjtesUser.php` | —                                                           |
| Detail pendaftaran              | `simagis/detailPendUjtesUser.php` | —                                                           |
| Cetak Form A1/A2                | `simagis/cetakFormA1A2User.php`   | Berkas cetak ujian tesis                                    |
| Cetak jadwal ujian              | `simagis/cetakJadwalUjtes.php`    | —                                                           |

---

### 9. Upload Revisi Tesis

| Fitur                    | File PHP                                 | Keterangan              |
| ------------------------ | ---------------------------------------- | ----------------------- |
| Form upload revisi tesis | `simagis/formRevisiTesis.php`            | Upload file tesis final |
| Edit revisi tesis        | `simagis/includeEditFormRevisiUjtes.php` | —                       |

---

### 10. Download & Informasi

| Fitur            | File PHP                                 | Keterangan                        |
| ---------------- | ---------------------------------------- | --------------------------------- |
| Download berkas  | `simagis/downloadUser.php`               | Download file yang diupload admin |
| Lihat pengumuman | `simagis/detailPengumumanUser.php`       | Info dari admin                   |
| Kontak layanan   | `simagis/kontakUser.php`                 | Info kontak jurusan               |
| SOP (prosedur)   | `simagis/sopPac.php`, `sopPprp.php`, dll | Lihat SOP pengajuan               |

---

## ═══════════════════════════════════

## 👨‍💼 ROLE: ADMIN BAK S1

**Dashboard:** `dashboardAdmBakS1.php`  
**Navigasi:** `navSideBarAdmBakS1.php`

## ═══════════════════════════════════

### 1. Manajemen Periode & Verifikasi

| Modul                           | File Utama                         | Fungsi                                           |
| ------------------------------- | ---------------------------------- | ------------------------------------------------ |
| Periode Pengajuan Dospem        | `pngjnDospemAdm.php`               | Buka/tutup periode, input periode baru           |
| Verifikasi Dospem               | `verifikasiPengDospemAdm.php`      | Cek berkas, setujui/tolak Dospem 1, 2, dan judul |
| Rekap Dospem per periode        | `rekapDospemPerPeriodeAdm.php`     | Statistik dospem                                 |
| Daftar dosen & kuota            | `dospemPerPeriodeAdm.php`          | Input daftar dosen + set kuota 1 & 2             |
| Periode PKL                     | `pndftrnPklAdm.php`                | Buka/tutup periode PKL                           |
| Verifikasi PKL                  | `verpesPklPerPeriodeAdm.php`       | Terima/tolak pendaftaran PKL                     |
| DPL (Dosen Pembimbing Lapangan) | `dplPerPeriodeAdm.php`             | Input dan assign DPL                             |
| Nilai PKL                       | `nilaiPklPerPeriodeAdm.php`        | Input dan rekap nilai PKL                        |
| Periode Sempro                  | `pndftrnSemproAdm.php`             | Buka/tutup periode sempro                        |
| Verifikasi Sempro               | `verPndftrSemproAdm.php`           | Terima/tolak/catatan                             |
| Jadwal Sempro                   | `inputJadSemproPerPeriodeAdm.php`  | Input jadwal + assign penguji                    |
| Nilai Sempro                    | `rekapNilaiSemproAdm.php`          | Rekap & validasi nilai sempro                    |
| Cetak BA Sempro                 | `cetakBaSemproPerPeriodeAdm.php`   | Berita acara kosong/terisi                       |
| Periode Kompre                  | `pndftrnKompreAdm.php`             | Buka/tutup periode kompre                        |
| Verifikasi Kompre               | `verpesKomprePerPeriodeAdm.php`    | Terima/tolak                                     |
| Jadwal Kompre                   | `jadKomprePerPeriodeAdm.php`       | Input jadwal + assign pengawas                   |
| Nilai Kompre                    | `nilaiKomprePerPeriodeAdm.php`     | Input nilai per peserta                          |
| Periode Ujian Skripsi           | `pndftrnUjskripAdm.php`            | Buka/tutup periode                               |
| Verifikasi Ujian Skripsi        | `verPndftrUjskripAdm.php`          | Terima/tolak                                     |
| Jadwal Ujian Skripsi            | `inputJadUjskripPerPeriodeAdm.php` | Assign Ketua/Sekretaris/Utama                    |
| Nilai Ujian Skripsi             | `rekapNilaiUjskripAdm.php`         | Rekap & validasi nilai                           |
| Cetak BA Ujskrip                | `cetakBaUjskripPerPeriodeAdm.php`  | Berita acara kosong/terisi                       |

---

### 2. Manajemen Surat Mahasiswa

| Fitur                   | File Utama                                       | Keterangan                      |
| ----------------------- | ------------------------------------------------ | ------------------------------- |
| Dashboard semua surat   | `dataSuratMahasiswaAdm.php`                      | Rekap status 12 jenis surat     |
| Proses tiap jenis surat | `dataIowi/k/Imi/Imk/Itp/Iops/Ips/Kkb/...Adm.php` | Update status + buat surat      |
| Rekap per tahun         | `rekapSiowIndividuAdm.php`, dll                  | Rekap tahunan semua surat       |
| Ekspor Excel            | `eksporIowiPertahunAdm.php`, dll                 | Export ke Excel per jenis surat |
| Cetak rekap             | `cetakDataIowiPertahunAdm.php`, dll              | Print rekap per tahun           |

---

### 3. Bimbingan Skripsi & Tesis (Pembimbingan)

| Fitur                     | File PHP                   | Keterangan                    |
| ------------------------- | -------------------------- | ----------------------------- |
| Data pembimbingan skripsi | `rekapPembimbinganAdm.php` | Semua data bimbingan          |
| Pembimbing skripsi 1      | `pembimbingSkripsi1.php`   | Status bimbingan per Dospem 1 |
| Pembimbing skripsi 2      | `pembimbingSkripsi2.php`   | Status bimbingan per Dospem 2 |
| Pembimbing tesis 1 & 2    | `pembimbingTesis1/2.php`   | Status bimbingan S2           |

---

### 4. Rekap & Laporan

| Fitur                    | File PHP                     | Keterangan               |
| ------------------------ | ---------------------------- | ------------------------ |
| Rekap dospem             | `rekapDospemAdm.php`         | Semua periode            |
| Rekap PKL                | `rekapNilaiPklAdm.php`       | Nilai PKL semua angkatan |
| Rekap penguji sempro     | `rekapPengujiSemproAdm.php`  | Per penguji              |
| Rekap penguji ujskrip    | `rekapPengujiUjskripAdm.php` | Per peran                |
| Rekap BA Sempro          | `rekapBaSemproAdm.php`       | Berita acara             |
| Rekap BA Ujskrip         | `rekapBaUjskripAdm.php`      | Berita acara             |
| Ekspor semua data dospem | `eksporAllDataDospemAdm.php` | Excel                    |
| Cetak semua data         | `cetakAllDataDospemAdm.php`  | PDF                      |

---

### 5. Import Data Mahasiswa

| Fitur                        | File PHP                      | Keterangan            |
| ---------------------------- | ----------------------------- | --------------------- |
| Import data mahasiswa S1     | `imporDataMahasiswaS1.php`    | Upload Excel data mhs |
| Import user mahasiswa S1     | `imporUserMahasiswaS1.php`    | Upload akun login mhs |
| Import data pengajuan dospem | `imporPengajuanDospemAdm.php` | Impor massal dospem   |

---

## ═══════════════════════════════════

## 👨‍💼 ROLE: ADMIN BAK S2

**Dashboard:** `simagis/dashboardAdm.php`  
**Navigasi:** `simagis/navPendAdm.php`

## ═══════════════════════════════════

### 1. Data Mahasiswa S2

| Fitur                   | File PHP                           | Keterangan                    |
| ----------------------- | ---------------------------------- | ----------------------------- |
| Rekap semua mahasiswa   | `simagis/rekapMhsswAdm.php`        | Per angkatan, status          |
| Edit data mahasiswa     | `simagis/editMhsswPerAngkatan.php` | —                             |
| Update status mahasiswa | `simagis/updateStatusMhssw.php`    | Aktif/Cuti/Non-aktif/DO/Lulus |
| Update tanggal lulus    | `simagis/updateTglLulusMhssw.php`  | —                             |
| Update tanggal cuti     | `simagis/updateTglCutiMhssw.php`   | —                             |
| Update tanggal DO       | `simagis/updateTglDoMhssw.php`     | —                             |
| Import data mahasiswa   | `simagis/sformImportDataMhssw.php` | Upload dari Excel             |

---

### 2. Manajemen PPT (Pembimbing Tesis)

| Fitur                | File PHP                         | Keterangan                                |
| -------------------- | -------------------------------- | ----------------------------------------- |
| Dashboard PPT        | `simagis/rekapPptAdm.php`        | Semua pengajuan pembimbing                |
| Verifikasi PPT       | `simagis/verifikasiEditPpt.php`  | Set kuota, verifikasi Dospem 1 & 2, judul |
| Buka periode PPT     | `simagis/editPeriodePptAdm.php`  | Set tanggal                               |
| Per periode PPT      | `simagis/ptPerPeriode.php`       | Semua pengajuan per periode               |
| Cetak PPT            | `simagis/cetakPsipt.php`         | —                                         |
| Rekap judul proposal | `simagis/rekapJudulPropAdm.php`  | —                                         |
| Rekap judul tesis    | `simagis/rekapJudulTesisAdm.php` | —                                         |

---

### 3. Data Variabel Penelitian

| Fitur                       | File PHP                           | Keterangan           |
| --------------------------- | ---------------------------------- | -------------------- |
| Kelola variabel X-Y (admin) | `simagis/variabelxyAdm.php`        | Master data variabel |
| Kelola variabel mediator    | `simagis/variabelmediatorAdm.php`  | —                    |
| Kelola variabel moderator   | `simagis/variabelmoderatorAdm.php` | —                    |
| Kelola covariabel           | `simagis/covariabelAdm.php`        | —                    |

---

### 4. Manajemen Sempro Tesis

| Fitur                            | File PHP                                      | Keterangan               |
| -------------------------------- | --------------------------------------------- | ------------------------ |
| Buka periode sempro              | `simagis/editPeriodePendSemproAdm.php`        | Set tanggal + tahap      |
| Lihat semua pendaftar            | `simagis/pendaftarSemproPerPeriode.php`       | List lengkap pendaftar   |
| Input jadwal sempro              | `simagis/includeInputJadSemproPerPeriode.php` | Assign penguji + tanggal |
| Input penilaian (setelah sempro) | `simagis/formPenilaianSemproPerPeriode.php`   | Input nilai dari penguji |
| Validasi nilai sempro            | `simagis/updateValidasiPenilaianSempro.php`   | Final validasi           |
| Rekap semua pendaftaran          | `simagis/rekapPendSemproAdm.php`              | —                        |
| Rekap penguji                    | `simagis/rekapPengujiSemproAdm.php`           | —                        |
| Cetak BA sempro                  | `simagis/cetakBaSempro.php`                   | Berita acara             |

---

### 5. Manajemen Revisi Proposal

| Fitur                       | File PHP                                   | Keterangan                         |
| --------------------------- | ------------------------------------------ | ---------------------------------- |
| Rekap semua revisi proposal | `simagis/rekapRevisiProAdm.php`            | Per periode / semua                |
| Validasi revisi proposal    | `simagis/updateValidasiRevisiPro.php`      | Terima (`cek=2`) / Tolak (`cek=3`) |
| Detail revisi per individu  | `simagis/detailRevisiProPerIndAdm.php`     | —                                  |
| Cetak rekap revisi          | `simagis/cetakRevisiProPerPeriodeAdm.php`  | —                                  |
| Hapus revisi                | `simagis/deleteRevisiProPerPeriodeAdm.php` | —                                  |

---

### 6. Manajemen Ujian Tesis

| Fitur                      | File PHP                                     | Keterangan           |
| -------------------------- | -------------------------------------------- | -------------------- |
| Buka periode ujian tesis   | `simagis/editPeriodePendUjtesAdm.php`        | Set tanggal          |
| Lihat semua pendaftar      | `simagis/pendaftarUjtesPerPeriode.php`       | —                    |
| Input jadwal ujian tesis   | `simagis/includeInputJadUjtesPerPeriode.php` | Assign 4 penguji     |
| Input penilaian            | `simagis/formPenilaianUjtesPerPeriode.php`   | Nilai dari 4 penguji |
| Validasi nilai ujian tesis | `simagis/updateValidasiPenilaianUjtes.php`   | —                    |
| Rekap semua pendaftar      | `simagis/rekapPendUjtesAdm.php`              | —                    |
| Cetak BA ujian tesis       | `simagis/cetakBaUjtes.php`                   | —                    |

---

### 7. Revisi Tesis & Status Lulus

| Fitur                  | File PHP                              | Keterangan                     |
| ---------------------- | ------------------------------------- | ------------------------------ |
| Rekap revisi tesis     | `simagis/rekapRevisiTesAdm.php`       | —                              |
| Validasi revisi tesis  | `simagis/updateValidasiRevisiTes.php` | Terima / Tolak                 |
| Update mahasiswa LULUS | `simagis/updateStatusMhssw.php`       | Status = '2' → mahasiswa lulus |

---

### 8. Upload & Pengumuman

| Fitur                         | File PHP                           | Keterangan                 |
| ----------------------------- | ---------------------------------- | -------------------------- |
| Upload berkas untuk mahasiswa | `simagis/editUploadBerkas.php`     | Template, panduan, dll     |
| Rekap upload berkas           | `simagis/rekapUpload.php`          | —                          |
| Upload pengumuman             | `simagis/editUploadPengumuman.php` | Pengumuman untuk mahasiswa |
| Rekap pengumuman              | `simagis/rekapPengumuman.php`      | —                          |
| Kelola kontak layanan         | `simagis/kontakLayananAdm.php`     | Info kontak admin          |

---

## ═══════════════════════════════════

## 👨‍💼 ROLE: ADMIN KEPEGAWAIAN

**Dashboard:** `dashboardAdmKepeg.php`  
**Navigasi:** `navSideBarAdmKepeg.php`

## ═══════════════════════════════════

### Data Dosen & Tendik

| Fitur                       | File PHP              | Keterangan                        |
| --------------------------- | --------------------- | --------------------------------- |
| Data semua dosen            | `dtDosen.php`         | CRUD data dosen lengkap           |
| Edit data dosen             | `editDtDosen.php`     | Edit biodata, jabatan, pendidikan |
| Data tenaga kependidikan    | `dtTendik.php`        | CRUD data tendik                  |
| Edit tendik                 | `editDtTendik.php`    | —                                 |
| Jabatan akademik            | `dtJabDik.php`        | Master data jabatan akademik      |
| Jabatan struktural          | `dtJabSi.php`         | Master jabatan struktural         |
| Kategori pegawai            | `dtKatPeg.php`        | Master kategori                   |
| Pangkat                     | `dtPangkat.php`       | Master pangkat                    |
| PPK (Pejabat Penandatangan) | `dtPpk.php`           | Data PPK                          |
| Ubah NIP                    | `ubahNip.php`         | Ubah NIP pegawai                  |
| Berkas pegawai              | `dtBerkasPegawai.php` | Upload & kelola berkas            |
| Foto pegawai                | `dtFoto.php`          | Upload foto pegawai               |

---

## ═══════════════════════════════════

## 👨‍💼 ROLE: ADMIN BMN (Barang Milik Negara)

**Dashboard:** `dashboardAdmBmn.php`  
**Navigasi:** `navSideBarAdmBmn.php`

## ═══════════════════════════════════

### Inventaris Barang

| Fitur                           | File PHP                                  | Keterangan                   |
| ------------------------------- | ----------------------------------------- | ---------------------------- |
| Data barang                     | `dtBarang.php`                            | CRUD inventaris semua barang |
| Edit barang                     | `editDtBarang.php`                        | —                            |
| Upload foto barang              | `editImageBarang.php`                     | —                            |
| Ekspor barang (berbagai filter) | `eksporDtBarangPerKat/Merk/Status/...php` | Export ke Excel              |
| Cetak barang                    | `cetakDtBarangPerKat/Merk/...php`         | Print per kategori           |
| Data ruang                      | `dtRuang.php`                             | CRUD data ruangan            |
| Inventaris per ruang            | `dtDir.php`                               | Daftar barang per ruang      |
| Peminjaman barang               | `dtPinjamBarang.php`                      | Input peminjaman             |
| Pengembalian barang             | `dtBarangKembali.php`                     | Konfirmasi kembali           |
| Peminjaman ruang                | `dtPinjamRuang.php`                       | Input peminjaman ruang       |
| Pengembalian ruang              | `dtRuangKembali.php`                      | Konfirmasi kembali           |
| Kategori barang                 | `opsiKatBarang.php`                       | Master kategori              |
| Sub-kategori                    | `opsiSubKatBarang.php`                    | Master sub kategori          |
| Merk barang                     | `opsiMerkBarang.php`                      | Master merk                  |
| Kondisi barang                  | `opsiKonBarang.php`                       | Master kondisi               |
| Jenis ruang                     | `opsiJenRuang.php`                        | Master jenis ruang           |
| Sumber dana                     | `opsiSumDanaPerBarang.php`                | Master sumber dana           |

---

## ═══════════════════════════════════

## 👨‍💼 ROLE: ADMIN TATA PERSURATAN

**Dashboard:** `dashboardAdm.php`  
**Navigasi:** `navSideBarAdmTaper.php`

## ═══════════════════════════════════

### Surat Tugas (ST), Surat Keputusan (SK), Surat Undangan (SU)

| Fitur                         | File PHP                                                | Keterangan                |
| ----------------------------- | ------------------------------------------------------- | ------------------------- |
| Input Surat Tugas Kepanitiaan | `inputStKepanitiaanAdm.php`                             | ST untuk kepanitiaan      |
| Input ST Penunjukan           | `inputStPenunjukanAdm.php`                              | ST penunjukan jabatan     |
| Input ST SPD                  | `inputStSpdAdm.php`                                     | ST Surat Perjalanan Dinas |
| Input SPD                     | `inputSpdAdm.php`                                       | Surat Perjalanan Dinas    |
| Rekap Surat Tugas             | `rekapSuratTugasAdm.php`                                | —                         |
| Rekap SK                      | `rekapSuratKeputusanAdm.php`                            | —                         |
| Cetak SK                      | `cetakSTKepanitiaanAdm.php`, `cetakSTPenunjukanAdm.php` | —                         |
| Cetak SPD                     | `cetakSpdAdm.php`                                       | —                         |
| Kop Amplop                    | `cetakKopAmplopAdm.php`                                 | Cetak kop amplop          |
| Rekap kirim SK/ST/SU          | `rekapKirimSuratKeputusanAdm.php`                       | —                         |

### Agenda Surat Masuk & Keluar

| Fitur                                 | File PHP                        | Keterangan             |
| ------------------------------------- | ------------------------------- | ---------------------- |
| Input surat masuk                     | `inputAgendaSuratMasukAdm.php`  | Catat surat masuk      |
| Input surat keluar                    | `inputAgendaSuratKeluarAdm.php` | Catat surat keluar     |
| Lihat agenda masuk                    | `agendaSuratMasukAdm.php`       | Rekap surat masuk      |
| Lihat agenda keluar                   | `agendaSuratKeluarAdm.php`      | Rekap surat keluar     |
| Disposisi                             | `cetakDisposisiAdm.php`         | Cetak lembar disposisi |
| Rekap KFS (Kontribusi Eks Sekretaris) | `dataKontribEksekutorAdm.php`   | Rekap kontribusi       |

---

## ═══════════════════════════════════

## 👨‍🏫 ROLE: DOSEN

**Dashboard:** `dashboardBeritaAcaraSempro.php`  
**Navigasi:** `navSideBarDosen.php`

## ═══════════════════════════════════

### Berita Acara Seminar Proposal Skripsi

| Fitur                       | File PHP                                   | Keterangan                    |
| --------------------------- | ------------------------------------------ | ----------------------------- |
| Dashboard BA Sempro Skripsi | `dashboardBeritaAcaraSempro.php`           | Lihat jadwal yang harus di-BA |
| Isi BA sebagai Penguji 1    | `baSemproSkripsiPenguji1.php`              | Isi form BA                   |
| Isi BA sebagai Penguji 2    | `baSemproSkripsiPenguji2.php`              | —                             |
| Update catatan BA Penguji 1 | `updateCatatanBaSemproSkripsiPenguji1.php` | —                             |
| Update catatan BA Penguji 2 | `updateCatatanBaSemproSkripsiPenguji2.php` | —                             |

---

### Berita Acara Ujian Skripsi

| Fitur                            | File PHP                            | Keterangan              |
| -------------------------------- | ----------------------------------- | ----------------------- |
| Dashboard BA Ujskrip             | `dashboardBeritaAcaraUjskrip.php`   | —                       |
| Isi BA Ketua (10 item penilaian) | `baUjskripKetua.php`                | Khusus peran Ketua      |
| Isi BA Sekretaris                | `baUjskripSekretaris.php`           | Khusus peran Sekretaris |
| Isi BA Penguji Utama             | `baUjskripUtama.php`                | Khusus peran Utama      |
| Update item BA 1-10 (Ketua)      | `updateBa1-10UjskripKetua.php`      | Per item                |
| Update item BA (Sekretaris)      | `updateBa1-10UjskripSekretaris.php` | —                       |
| Update item BA (Utama)           | `updateBa1-10UjskripUtama.php`      | —                       |

---

### Berita Acara Sempro Tesis (S2)

| Fitur                        | File PHP                            | Keterangan       |
| ---------------------------- | ----------------------------------- | ---------------- |
| Dashboard BA Sempro Tesis    | `dashboardBeritaAcaraSemproTes.php` | —                |
| Cek kehadiran peserta sempro | `cekKehadiranPengujiSempro.php`     | Konfirmasi hadir |
| Isi BA Penguji 1             | `baSemproTesisPenguji1.php`         | —                |
| Isi BA Penguji 2, 3, 4       | `baSemproTesisPenguji2/3/4.php`     | —                |
| Update BA dari tiap penguji  | `updateBaSemproTesisPenguji1-4.php` | —                |

---

### Berita Acara Ujian Tesis (S2)

| Fitur                              | File PHP                              | Keterangan                      |
| ---------------------------------- | ------------------------------------- | ------------------------------- |
| Dashboard BA Ujian Tesis           | `dashboardBeritaAcaraUjTes.php`       | —                               |
| Cek kehadiran ujian tesis          | `cekKehadiranPengujiUjtes.php`        | —                               |
| Isi BA Section 1-7 Penguji 1       | `ba1-7UjianTesisPenguji1.php`         | 7 section × 4 penguji = 28 file |
| Isi BA Section 1-7 Penguji 2, 3, 4 | `ba1-7UjianTesisPenguji2/3/4.php`     | —                               |
| Update BA per section              | `updateBa1-7UjianTesisPenguji1-4.php` | —                               |

---

## 📊 RINGKASAN FITUR PER ROLE

| Fitur Utama        | Mhs S1 | Mhs S2 | Admin BAK S1 | Admin BAK S2 |   Dosen    | Admin Kepeg | Admin BMN | Admin Taper |
| ------------------ | :----: | :----: | :----------: | :----------: | :--------: | :---------: | :-------: | :---------: |
| Profil Mahasiswa   |   ✅   |   ✅   |      ❌      |      ✅      |     ❌     |     ❌      |    ❌     |     ❌      |
| Pengajuan Dospem   |   ✅   |   ✅   |  Verifikasi  |  Verifikasi  |     ❌     |     ❌      |    ❌     |     ❌      |
| Pendaftaran PKL    |   ✅   |   ❌   |    Kelola    |      ❌      |     ❌     |     ❌      |    ❌     |     ❌      |
| Seminar Proposal   |   ✅   |   ✅   |    Kelola    |    Kelola    | BA + Nilai |     ❌      |    ❌     |     ❌      |
| Ujian Kompre/Tesis |   ✅   |   ✅   |    Kelola    |    Kelola    | BA + Nilai |     ❌      |    ❌     |     ❌      |
| Permohonan Surat   |   ✅   |   ✅   |    Proses    |    Proses    |     ❌     |     ❌      |    ❌     |     ❌      |
| SKKM               |   ✅   |   ❌   |     View     |      ❌      |     ❌     |     ❌      |    ❌     |     ❌      |
| Data Dosen/Tendik  |   ❌   |   ❌   |      ❌      |      ❌      |     ❌     |     ✅      |    ❌     |     ❌      |
| Inventaris Barang  |   ❌   |   ❌   |      ❌      |      ❌      |     ❌     |     ❌      |    ✅     |     ❌      |
| Surat Resmi        |   ❌   |   ❌   |      ❌      |      ❌      |     ❌     |     ❌      |    ❌     |     ✅      |
| Berita Acara       |   ❌   |   ❌   |    Rekap     |    Rekap     |     ✅     |     ❌      |    ❌     |     ❌      |

---

## 🔑 TABEL DATABASE UTAMA PER ROLE

| Role         | Tabel Utama                                                                                                                                |
| ------------ | ------------------------------------------------------------------------------------------------------------------------------------------ |
| Mahasiswa S1 | `dt_mhssw`, `pengelompokan_dospem_skripsi`, `peserta_sempro`, `peserta_kompre`, `peserta_ujskrip`, `peserta_pkl`                           |
| Mahasiswa S2 | `mag_dt_mhssw_pasca`, `mag_pengelompokan_dospem_tesis`, `mag_peserta_sempro`, `mag_peserta_ujtes`, `mag_revisi_sempro`, `mag_revisi_tesis` |
| Admin BAK S1 | `pendaftaran_sempro`, `jadwal_sempro`, `nilai_sempro`, `dospem_skripsi`, `pendaftaran_pkl`                                                 |
| Admin BAK S2 | `mag_periode_pendaftaran_sempro`, `mag_nilai_sempro`, `mag_periode_pendaftaran_ujtes`, `mag_nilai_ujtes`                                   |
| Dosen        | `nilai_sempro`, `nilai_ujskrip`, `mag_nilai_sempro`, `mag_nilai_ujtes`                                                                     |
| Admin Kepeg  | `dt_pegawai`, `dt_dosen`, `dt_tendik`                                                                                                      |
| Admin BMN    | `dt_barang`, `dt_ruang`, `dt_peminjaman_barang`, `dt_dir`                                                                                  |
| Admin Taper  | `surat_keluar`, `surat_masuk`, `st_kepanitiaan`, `spd`                                                                                     |

---

_Dokumen ini dibuat berdasarkan analisis source code proyek psycoapp._  
_Total file PHP: ≈2000+ file | Dibuat: 2026-03-05_
