# Alur Pengajuan Academic Coach Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ (alur proses) pengajuan dan penempatan _Academic Coach_ (Dosen Wali/Pendamping) bagi Mahasiswa S2 pada SIMAGIS.

## Keterlibatan Peran (Roles)

- **Mahasiswa S2**: Memilih/mengusulkan Academic Coach pendamping ketika periode dibuka.
- **Academic Coach (Dosen/Wali)**: Menyetujui bimbingan mahasiswa di sistem, atau otomatis diplot oleh program studi.
- **Admin BAK S2 / Adm Prodi**: Menetapkan periode pendaftaran, dan memploting / memvalidasi hasil pembagian mahasiswa S2.

## Tabel Database yang Terkait

| Nama Tabel                     | Deskripsi                                                                                | Perubahan (Dampak Transaksi)                                                                               |
| ------------------------------ | ---------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------- |
| `mag_periode_pengajuan_ac`     | Tabel jadwal & periode (waktu mulai - waktu akhir) pendafataran usulan Academic Coach.   | Dikontrol/dibuka oleh Admin BAK / Kaprodi.                                                                 |
| `mag_dosen_wali`               | Daftar/Database Master dosen S2 yang memenuhi syarat / bersedia menjadi Wali Tesis (AC). | Pengaturan referensi Dosen.                                                                                |
| `mag_pengelompokan_dosen_wali` | Tabel definitif relasi antara 1 (satu) orang Mahasiswa S2 dengan AC yang mendampinginya. | Di-_insert_ saat mahasiswa usul (Status Draft / Pending), lalu di-_update_ menjadi (Disetujui) oleh Admin. |

## Flow (Alur Kerja) Academic Coach (AC)

1. **Setting Periode (Admin BAK S2)**: Admin BAK atau KaProdi membuka jadwal penerimaan / pemilihan AC melalui pengisian di `mag_periode_pengajuan_ac`.
2. **Pengajuan (Mahasiswa)**: Mahasiswa S2 _login_ SIMAGIS, lalu masuk ke `Pengajuan -> Academic Coach` (formPengajuanAc). Pilih AC yang diinginkan dari _dropdown list_ berdasar data `mag_dosen_wali` (dan mungkin berdasar ketersediaan kuota).
3. **Persetujuan Pembimbing (Dosen)**: (Skenario Tambahan) Dosen pengajar/calon AC mengecek profil, rancangan, atau judul, lantas menyetujui ketersediaan via SIMAGIS.
4. **Verifikasi Admin BAK (SK)**: Admin BAK memverifikasi daftar mahasiswa beserta Dosen wali. Jika memenuhi kapasitas/rasio bimbingan dan _Acc_ KaProdi, kemudian Admin melakukan "sah". Status pengajuan _Update_ di tabel `mag_pengelompokan_dosen_wali`.
5. **Bimbingan Dimulai**: Status tervalidasi. Mahasiswa memantau lewat dashboard. Dosen pendamping aktif memonitor studi / persiapan Sempro.
