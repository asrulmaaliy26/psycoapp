# Tampilan dan Peran Dosen Magister (S2) Khusus di SIMAGIS

Dokumen ini memetakan _flow_ (alur proses) serta kedudukan **Dosen Fakultas/Program Studi (S2)** di dalam interaksi terfokus pada modul **SIMAGIS**.

Berbeda dengan pandangan Mahasiswa atau Admin BAK, interaksi digital secara langsung (via Portal Login SIMAGIS) bagi dosen **tidak berdiri sendiri**. Di dalam arsitektur `SIMAGIS`, **Tidak Terdapat Modul/Tampilan Login Otentik Khusus Dosen** melainkan Dosen Magister diposisikan sebagai _Actor / Entity_ utama yang kegiatannya dikelola (_bridged_) oleh Admin BAK/Kaprodi.

## Hak Akses & Keterbatasan Tampilan

- **Tidak Ada Login Akses Dosen (_User Role_)**: SIMAGIS sejauh ini hanya menyediakan jalur login untuk 2 pihak: **Mahasiswa Magister** (`index.php`/`logUser.php`) dan **Admin BAK S2** (`admin.php`/`logAdm.php`).
- **Pihak Eksekutif Keputusan**: Dosen Magister memberikan lampu hijau / nilai / persetujuan di luar aplikasi (atau via modul lain/fisik), yang kemudian **datanya di-_input_ atau digenerasikan secara _digital_ oleh Admin BAK S2**.

## Struktur Representasi (Peran Dosen di SIMAGIS)

Dosen berpartisipasi langsung dan menjadi parameter wajib dalam hampir setiap menu pengajuan mahasiswa, perannya dipetakan sebagai berikut:

### 1. Kedudukan di Master Data & Referensi Akademik

- Nama, Gelar, Jabatan/Pangkat (**opsi_jabatan**), Status Kepegawaian (**opsi_status_pegawai**), dan _Kepakaran Mayor_ Dosen direkam melalui tabel `mag_dospem_tesis` dan `mag_dosen_wali`.
- Data keahlian kepakaran Dosen di-_load_ oleh mahasiswa di dalam _dropdown_ form pengajuan `Pembimbing Tesis` maupun `Academic Coach` mereka untuk dicocokkan dengan **Rumpun Tesis**.

### 2. Kedudukan Sebagai Academic Coach (Dosen Wali S2)

Saat mahasiswa melakukan **Pengajuan Peminatan Rumpun** & **Academic Coach**:

- **Alur (_Behind the Scene_)**: Dosen berdiskusi (ekstra-sistem/fisik) dengan mahasiswa Peminat S2.
- Setelah Kaprodi atau Dosen menyetujuinya, Admin S2 mengeksekusi _Approval Validation_ `opsi_validasi` pada tabel `mag_pengelompokan_dosen_wali`.
- Dosen diplot untuk melakukan pemantauan Tesis / bimbingan proposal, namun Dosen _tidak me-review-nya langsung lewat SIMAGIS_.

### 3. Kedudukan Sebagai Dosen Pembimbing Tesis

Saat mahasiswa melaju di Pengajuan **Dosen Pembimbing Tesis (PPT)**:

- Mahasiswa mengusulkan form kombinasi Dosen (Pembimbing Utama & Pembimbing Pendamping).
- Kuota maksimum jumlah bimbingan tiap Dosen akan ditabulasi oleh SIMAGIS. Apabila Dosen X sudah **Penuh (Full Quota)**, Admin menolak / mengalihkan pilihan (Revisi Pilihan Dosen).
- Dosen (_sebagai objek verifikasi_) mendapatkan _SK penunjukan Berita Acara_ cetak `cetakBaSempro.php` dari sistem begitu disahkan.

### 4. Kedudukan Sebagai Penguji (Sempro / Ujian Tesis Akhir)

Pada tahapan kritikal _Seminar Proposal_ dan _Ujian Tesis Akhir_:

- Dosen **Di-Plot Jadwal Sidangnya** oleh Admin (Kapan ujian, jam berapa, ruang mana).
- Dosen ditetapkan status kedudukannya sesuai **`opsi_menguji_sempro_tesis`** (_Ketua Penguji, Anggota Penguji 1, Anggota Penguji 2_).
- Dosen bisa **dicatat absensinya (Cek Kehadiran)** oleh Admin BAK S2 (`cekKehadiranPengujiSempro.php`).
- **Input Nilai Manual-to-Digital**: Saat Ujian Tesis usai, kertas/skor/borang manual yang Dosen tulis diserahkan ke Sekretariat. Asisten/Admin S2 kemudian mengkonversi **(_Input Grading_)** nilai numerik _borang_ sang Dosen menjadi Angka di `mag_nilai_ujtes` & melahirkan _Grade/Status Yudasium_ (`mag_grade_ujtes`).
- **Validasi Revisi Mhs**: Sewaktu mahasiswa Upload Laporan Perbaikan (Revisi Bab) ke sistem SIMAGIS (`mag_revisi_tesis`), Dosen kembali mengeceknya di luar sistem, lalu memberi notifikasi ke Biro Akademik agar mencentang parameter persetujuan `opsi_validasi_revisi` menjadi _Valid_.

## Kesimpulan Alur Kerja Dosen

Dosen Magister (S2) berperan sentral secara _akademik_ bagi tesis Mahasiswa. Namun secara teknikalitas di portal SIMAGIS, Dosen lebih merupakan **Subjek Manajerial** yang beban bimbingannya (`mag_pengelompokan_rumpun`, dll) **dipantau, dijadwalkan secara rapi, dan difinalisasi** _(input nilai & input berita acara kelulusan)_ oleh fasilitator utama SIMAGIS yakni **Admin BAK S2**.
