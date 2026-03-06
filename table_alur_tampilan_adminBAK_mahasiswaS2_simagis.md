# Tampilan dan Alur Fitur Khusus Admin BAK S2 di SIMAGIS

Dokumen ini memetakan _flow_ (alur proses) dan tampilan fungsional (_Dashboard_ & _Menu Navigasi_) dari portal **Admin BAK S2 (Bagian Akademik Pascasarjana)** di dalam sistem **SIMAGIS**.

Admin SIMAGIS bertugas sebagai pengelola utama dan verifikator dari segala pengajuan administratif dan akademik mahasiswa Magister (S2).

## Hak Akses & Tampilan Utama

- **Login / Akses**: Laman login khusus admin di-_route_ melalui `admin.php` atau `logAdm.php`, yang memverifikasi kredensial (_username_ & _password_) ke tabel `mag_dt_admin_bak`.
- **Dashboard (`dashboardAdm.php`)**: Memuat ringkasan data, notifikasi pengajuan baru dari mahasiswa S2 yang menunggu validasi, dan pintasan _Quick Access_ ke fitur operasional harian.

## Struktur _Menu_ Tampilan Admin BAK S2

Berikut merupakan uraian fitur per modul di dalam _Navbar_ (`navDashAdm.php`) admin:

### 1. Menu Pengajuan (_Monitoring Usulan Awal_)

Admin melihat _list_ draf/permohonan mahasiswa yang masuk untuk diverifikasi dan diterbitkan SK/Berita Acaranya.

- **Peminatan Rumpun Psikologi (`rekapPprpAdm.php`)**: Menerima/mengecek pilihan _interest_ riset Maba S2. Admin akan meresmikan pilihan tersebut (_approve_ ke `mag_pengelompokan_rumpun`).
- **Academic Coach (`rekapPacAdm.php`)**: Verifikasi _plotting_ mahasiswa ke _Academic Coach_ (Dosen Wali), mengatur rasio bimbingan.
- **Pembimbing Tesis (`rekapPptAdm.php`)**: Verifikasi Dosen Pembimbing Tesis usulan mahasiswa. Admin meneruskan _approval_ KaProdi perihal SK Penunjukan ke dalam sistem dan menyematkan _status validasi_ (Kunci akhir PT Mahasiswa).
- **SIPT & SIOW (`rekapPsiptAdm.php` & `rekapSiowAdm.php`)**: Validasi lampiran, pembuatan & _generate_ surat balasan ber-TTE/Kop surat bagi entri Penelitian Tesis dan Observasi/Wawancara (Surat Izin).

### 2. Menu Pendaftaran (_Operasional Ujian & Seminar_)

Menu vital proses administrasi penjadwalan. Membawahi 4 pilar sidang:

- **Seminar Proposal (`rekapPendSemproAdm.php`) & Ujian Tesis (`rekapPendUjtesAdm.php`)**:
  - Admin membuat periode pendaftaran (tanggal buka & tutup formulir mhs).
  - Admin melakukan kurasi (_screening_) kelengkapan _Turnitin, TOFEL, Transkrip_.
  - Jika _Acc_, Admin membuat _Plotting Jadwal_ (ruangan, waktu).
  - Mengunci / _assign_ tim **Dosen Penguji Utama, Ketua, dan Anggota**.
  - Meng-_input_ lembar _grading/nilai_ pasca dosen menyerahkan nilai sidang lapangan.
  - Mem-_print_ dan mem-verifikasi **Berita Acara** sidang kelulusan.
- **Revisi Sempro & Tesis (`rekapRevisiProAdm.php` & `rekapRevisiTesAdm.php`)**: Admin/Asisten prodi melakukan pengecekan terakhir (validasi `mag_opsi_validasi_revisi`) atas PDF naskah yang direvisi Mahasiswa untuk mengurus \*clearance\_ atau pendaftaran Yudisium.

### 3. Master Data (_Setelan Referensi Utama S2_)

Pengaturan basis data entitas (_CRUD/Settings_).

- **Data Dosen (`rekapDosenAdm.php`)**: Menambah/Sinkronisasi Dosen S2 Magister, Keahlian & kapasitas beban kuota bimbingan dari tabel Induk.
- **Data Mahasiswa S2 (`rekapMhsswAdm.php`)**: Pusat Profil, _reset password_, _Status Aktif/Cuti/DO_.
- **Kontak Layanan (`kontakLayananAdm.php`)**: Setting informasi narahubung/biro untuk tampilan footer layanan Mhs S2.
- **Data Riset**: Judul Proposal, Judul Tesis, dan Bank Variabel Penelitian (`variabelxyAdm.php`).

### 4. Setting SOP

Admin bertugas mengunggah dan memutakhirkan modul tata cara akademis S2. Berisi fitur penyuntingan instrumen HTML untuk _SOP Rumpun, Academic Coach, Pembimbing Tesis, Sempro & Ujian Akhir_. Informasi ini adalah pop-up _Guidelines_ pada sisi mahasiswa.

### 5. Upload (_Penyiaran_)

- **Berkas (`rekapUpload.php`)**: Menaruh _Formulir Kosong, Template Jurnal, Pedoman Tesis_ ke dalam wadah File supaya dapat di-_download_ oleh Mahasiswa S2 (tabel `mag_upload_berkas`).
- **Pengumuman (`rekapPengumuman.php`)**: Dashboard buletin/info pengumuman darurat, batas KRS S2, pengumuman publik prodi S2.

## Kesimpulan Alur Kerja Admin

Admin Biro Akademik/S2 berperan sebagai **Korektor Pusat** & **Dispatcher**. Setiap kali mahasiswa membuat aksi di _form User_, status datanya akan memantik Admin S2. Admin akan merespon usulan masuk, mem-_plotting_, menerbitkan Surat/BA, dan mencentang _Validasi Finish_ yang kemudian meng-_update_ tampilan Dasbor mahasiswa bersangkutan.
