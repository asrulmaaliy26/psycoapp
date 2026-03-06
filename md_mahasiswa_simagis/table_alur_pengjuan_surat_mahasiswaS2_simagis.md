# Alur Pengajuan Surat Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ (alur proses) pengajuan surat permohonan oleh Mahasiswa S2 (Magister) didalam aplikasi **Simagis**, beserta relasi tabel database yang bersangkutan dengan peran Admin BAK.

## Keterlibatan Peran (Roles)

- **Mahasiswa S2**: Memulai permohonan surat melalui menu Permohonan Surat.
- **Admin/Staf BAK S2**: Memvalidasi identitas, format, dan mengeluarkan/mencetak surat akademik yang diajukan oleh mahasiswa.

## Tabel Database yang Terkait

| Nama Tabel                    | Deskripsi                                                                                          | Perubahan (Dampak Transaksi)                                        |
| ----------------------------- | -------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------- |
| `mag_sipt`                    | Tabel pengajuan/Surat Izin Penelitian Tesis.                                                       | Ditambahkan/di-_insert_ oleh Mahasiswa S2 saat mengisi _formSipt_.  |
| `mag_siowi`                   | Tabel pengajuan Izin Observasi dan Wawancara Matakuliah/Individu.                                  | Ditambahkan oleh Mahasiswa S2 saat mengajukan _formSowam_.          |
| `mag_tembusan_surat_ak`       | Menyimpan daftar tujuan tembusan surat (siapa saja pihak yang menerima turunan dari surat admin).  | Dikelola (baca/tulis) oleh Admin/BAK S2 saat surat diterbitkan.     |
| `kode_surat`                  | Penomoran surat resmi akademik dari Tata Usaha/BAK.                                                | Di-_setup_ dan dikeluarkan oleh Admin BAK S2.                       |
| `opsi_status_pengajuan_surat` | Melacak posisi permohonan surat (misalnya: _Menunggu Validasi_, _Disetujui_, _Revisi_, _Ditolak_). | Digunakan Admin BAK untuk memberi _update_ status kepada mahasiswa. |

## Flow (Alur Kerja) Surat Menyurat

1. **Pendaftaran (Mahasiswa)**: Mahasiswa memilih menu `Permohonan Surat` (SIPT atau Observasi/Wawancara).
2. **Input Data**: Mahasiswa S2 mengisi data subjek penelitian, lokasi Instansi (menggunakan data `alamat_lembaga` / `nama_lembaga`), dll. Data masuk ke `mag_sipt` atau `mag_siowi`.
3. **Penerimaan/Verifikasi (Admin BAK S2)**: Dashboard Admin BAK S2 akan memunculkan adanya pengajuan masuk. Admin kemudian memeriksa keabsahan syarat permohonan.
4. **Penerbitan**: Jika _Acc_, Admin BAK melakukan generate surat yang menyematkan nomor (`kode_surat`), memberi `mag_tembusan_surat_ak`, meng-_update_ `opsi_status_pengajuan_surat`.
5. **Surat Jadi**: Admin meng-_upload_ kembali / mengirimkan notifikasi. Mahasiswa bisa mengunduh soft-file surat atau datang ke loket BAK.
