# Alur Penggunaan Fasilitas "Bank" Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ (alur proses) dari fitur/menu **Bank** yang tersedia pada portal Mahasiswa Magister (S2) di SIMAGIS. Menu Bank di sini tidak berkaitan dengan transaksi pembayaran finansial (_keuangan_), melainkan berupa **Bank Berkas**, **Bank Judul Tesis**, dan **Bank Variabel Penelitian Tesis**.

## Keterlibatan Peran (Roles)

- **Mahasiswa Magister**: Pengguna aktif (_end-user_) portal Bank S2. Mengakses file panduan, dan mencari insiprasi judul & variabel tesis untuk penyusunan Bab 1-3.
- **Admin BAK S2**: Pihak _Uploader_ atau pengunggah master berkas panduan/SOP. Mengelola Master Data instrumen penelitian dan mengkategorikan variabel penelitian mahasiswa/dosen lampau.

## Tabel Database yang Terkait

| Nama Tabel                                         | Deskripsi Fitur Bank di Aplikasi Simagis                                                                                                                                                                                                                            |
| -------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **_Fitur 1: Download Berkas / Dokumen / Panduan_** |                                                                                                                                                                                                                                                                     |
| `mag_upload_berkas` <br> (atau `upload_berkas`)    | Menyimpan _path file_ / dokumen (_PDF, DOCx_) pedoman akademik S2 (Buku Panduan, Template Jurnal Sinta, Syarat Cek Plagiasi).                                                                                                                                       |
| `kategori_upload_berkas`                           | Mengelompokkan tabel dokumen agar mahasiswa bisa men-filter jenis file (Misal: _kategori_skripsi_, _kategori_Panduan Tesis_, dll) di tampilan `downloadUser.php`.                                                                                                   |
| **_Fitur 2: Bank Variabel & Instrumen Tesis_**     |                                                                                                                                                                                                                                                                     |
| `mag_variablexy`                                   | _Database Dictionary_ yang menyimpan Variabel Independen (X) dan Variabel Dependen (Y) penelitian terdahulu sebagai referensi/bank ide Mahasiswa.                                                                                                                   |
| `mag_covariable`                                   | Bank inspirasi untuk data kovariabel pendukung (Kuantitatif tipe ANOVA/ANCOVA).                                                                                                                                                                                     |
| `mag_mediatorvariable`                             | Memuat contoh / daftar instrumen variabel Mediator S2.                                                                                                                                                                                                              |
| `mag_moderatorvariable`                            | Memuat contoh / daftar referensi variabel Moderator.                                                                                                                                                                                                                |
| `mag_jns_alat_ukur`                                | Daftar inventori alat ukur Psikologi (Tes kognitif, Skala, Inventori Kepribadian) yang diabsahkan/didaftarkan prodi untuk dipakai reset/riset Tesis.                                                                                                                |
| `mag_jns_pen`                                      | Referensi jenis metodologi penelitian.                                                                                                                                                                                                                              |
| **_Fitur 3: Bank Judul Tesis_**                    |                                                                                                                                                                                                                                                                     |
| `mag_peserta_ujtes` / `mag_peserta_sempro`         | _(Derived table)_ Tabel operasional ini memuat "Field Judul Proposal/Tesis" yang telah lulus ujian/ACC dospem. Tabel ini di-_query_ oleh laman `judulTesisUser.php` agar mahasiswa yang baru masuk (Maba S2) bisa mencari judul kakak tingkat yang sudah _publish_. |

## Flow (Alur Kerja) Menu "Bank" S2

1. **Populating Data (Admin BAK S2)**:
   - Admin secara _periodik_ meng-_upload_ berkas panduan (Buku Akademik, Panduan Penulisan Sinta, Syarat Pendaftaran Sempro) ke tabel katalog dokumen (`mag_upload_berkas`).
   - Admin/Dosen menstandardisasi _tagging_ dan input Variabel (_Variabel X_, _Y_, _Moderator_) beserta _Alat Ukur_ yang lolos kurasi riset publikasi ke tabel `mag_variablexy`, `mag_jns_alat_ukur`, dst.
2. **Eksplorasi (Mahasiswa)**: Mahasiswa tingkat 1 / pra-sempro yang _stuck_ mencari ide penelitian masuk ke Dashboard SIMAGIS dan membuka menu _Bank_:
   - Klik `Bank -> Berkas`: Untuk mengunduh PDF form usulan, template proposal (disederhanakan dari tabel `mag_upload_berkas`).
   - Klik `Bank -> Judul Tesis`: Untuk _search_ (_query_) ke arsip `mag_peserta_ujtes` / data _Library_ Tesis lulus. Mencegah duplikasi riset (_Plagiarisme_ ide).
   - Klik `Bank -> Variabel Tesis`: Menjelajah dan mencocokan skala ukur Psikologi yang _available_ di Laboratorium berdasar input `mag_jns_alat_ukur` yang dirangkum Admin S2.
3. **Pemanfaatan Ekosistem**: Mahasiswa lalu merumuskan rancangan Tesis untuk dimintakan persetujuan ke Academic Coach / Dosen Pembimbing Tesisnya.
