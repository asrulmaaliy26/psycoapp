# Alur Pendafataran dan Ujian Tesis (Termasuk Revisi) Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ (alur proses) pendaftaran, pendataan jadwal, pelaksanaan Sidang, hingga pengunggahan Revisi **Ujian Tesis Akhir** bagi Mahasiswa S2 pada aplikasi Simagis.

## Keterlibatan Peran (Roles)

- **Mahasiswa Magister**: Peserta sidang tesis, memenuhi syarat akademik/bebas finansial/kustodian, kemudian mendaftar dan mematuhi arahan revisi jika ada perbaikan minor/major paska sidang.
- **Admin BAK / Admin S2**: _Gatekeeper_ verifikasi syarat Sidang (turnitin/skkm/etc), pembuat Berita Acara (BA), SK Jadwal Ujian, serta pembuat sertifikat surat Lulus.
- **Ketua / Dosen Penguji Ujian**: Memberikan Nilai dan _Assessment_, dan mencentang (klik validasi) _clearance_ tesis mahasiswa apabila perbaikan paska Ujian sudah paripurna.

## Tabel Database yang Terkait

| Nama Tabel                                     | Rincian Fungsionalnya di Aplikasi                                                                                                            |
| ---------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------- |
| **_Tahap 1: Pendaftaran / Penjadwalan_**       |                                                                                                                                              |
| `mag_periode_pendaftaran_ujtes`                | Tabel konfigurasi batas waktu Kapan Form Pendaftaran Ujian Tesis dibuka (Start_date & End_date). Dikelola oleh Admin / Kaprodi.              |
| `mag_peserta_ujtes`                            | Database _listing_ pendaftaran mahasiswa S2 berserta Judul/Topik Mutakhir. Data di-Acc/ditolak oleh tim Administrasi lewat tabel ini.        |
| `mag_jadwal_ujtes`                             | Memuat slot waktu (Hari, Tanggal, Jam) serta Alokasi Ruang Sidang dan Link (Hybrid) pelaksanaan.                                             |
| `opsi_menguji_ujian_tesis`                     | Konvensi peranan tim penguji ujian. _Dropdown_ Ketua Tim, Anggota Penguji 1, Anggota Penguji 2.                                              |
| `mag_opsi_tahap_ujprop_ujtes`                  | Identifikasi urutan ujian apabila Mahasiswa melakukan Ujian Tertutup vs Terbuka.                                                             |
| **_Tahap 2: Input Grading & Parameter Nilai_** |                                                                                                                                              |
| `mag_nilai_ujtes`                              | Penilaian instrumen Ujian oleh Penguji (Skor per elemen).                                                                                    |
| `mag_grade_ujtes`                              | Rangkuman agregat nilai akhir / Status LULUS (A, B, Mengulang).                                                                              |
| `mag_opsi_validasi_nilai_ujtes`                | _Triggering tag_ yang mencatat status Pengesahan final (SK/BA Lulus Ujian_Tesis).                                                            |
| **_Tahap 3: Pelampiran / Pasca Sidang Tesis_** |                                                                                                                                              |
| `mag_revisi_tesis`                             | Mahasiswa yang mendapat _Grade_ dengan status _revisi (minor/major)_, perlu mengunggah file hasil bimbingan revisi. Tabel ini log revisinya. |
| `mag_opsi_validasi_revisi`                     | _Flag_ verifikator, yang disetujui Dosen Penguji agar form Yudasium Mahasiswa terbuka.                                                       |

## Flow (Alur Kerja) Ujian Tesis

1. **Syarat Terpenuhi (Mahasiswa)**: Mahasiswa menekan pendaftaran _formPendUjTes_ (Pendaftaran Ujian Tesis) saat `mag_periode_pendaftaran_ujtes` telah divalidasi pembukaannya.
2. **Rekap Pendaftar (Admin BAK)**: Admin S2 mengecek lampiran Turnitin/Publikasi Sinta. Bila layak, dimasukan/divalidasi sebagai peserta (`mag_peserta_ujtes`).
3. **Ploting SK & Waktu Ujian (Admin)**: Menerbitkan `mag_jadwal_ujtes` serta alokasi `opsi_menguji_ujian_tesis` (menyematkan 3-4 Dosen ke jadwal tsb).
4. **Sidang Akhir (Penguji)**: Dosen / Admin merekap penilaian di _form grading_ (`mag_nilai_ujtes`, `mag_grade_ujtes`). Apabila Dosen memasukan _Grade Lulus dengan Revisi_, Admin mengeluarkan Berita Acara yang memuat arahan revisi (`mag_opsi_validasi_nilai_ujtes`).
5. **Aksi Mahasiswa Pasca Ujian (Upload)**: Masuk SIMAGIS menu _Pendaftaran -> Upload Revisi Ujian Tesis_ (_formRevisiTesis_). Mahasiswa MENGUNGGAH Tesis full text / Naskah perbaikan (`mag_revisi_tesis`).
6. **Validasi File Terakhir (Dosen/Biro Skripsi)**: Tim dosen yang relevan atau penguji mengecek kembali dokumen. Apabila disetujui, Admin/Dosen mencentang `mag_opsi_validasi_revisi` menjadi **Clear**.
7. **LULUS / Pra-Yudisium**: Mahasiswa S2 resmi selesai Ujian!
