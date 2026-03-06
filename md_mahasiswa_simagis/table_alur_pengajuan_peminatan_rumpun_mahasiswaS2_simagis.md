# Alur Pengajuan Peminatan & Rumpun Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ pengajuan "Peminatan Rumpun Psikologi" atau program spesialisasi oleh Mahasiswa Magister (S2) dan bagaimana Admin BAK S2 memproses pembagian tersebut.

## Keterlibatan Peran (Roles)

- **Mahasiswa S2**: Mengajukan program Peminatan Rumpun di SIMAGIS.
- **Ketua Program Studi (Kaprodi) / Dosen**: (Opsional) Mengulas kesesuaian/latar belakang jika diperlukan.
- **Admin BAK S2**: Mengelola jadwal pemilihan, validasi/verifikasi kelompok, dan mencatat mahasiswa ke dalam rumpun yang dipilih.

## Tabel Database yang Terkait

| Nama Tabel                 | Deskripsi                                                                                          | Perubahan (Dampak Transaksi)                                                       |
| -------------------------- | -------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `peminatan`                | Data utama program peminatan (misal: Psikologi Klinis, Industri/Organisasi, Pendidikan).           | Dikelola (baca/tulis) oleh Admin/Kaprodi untuk penambahan/penghapusan.             |
| `minat`                    | Label rincian/kategori dari suatu konsentrasi peminatan di Magister.                               | Referensi _dropdown_ untuk formulir (_formPengajuanPrp_).                          |
| `mag_opsi_rumpun`          | Pilihan Rumpun Tesis S2 (Pengelompokan rumpun sesuai kebijakan Pascasarjana).                      | Digunakan saat pemilihan rumpun.                                                   |
| `mag_pengelompokan_rumpun` | Basis data mapping yang mengikat Mahasiswa S2 dengan program rumpun yang dipilih secara disetujui. | _Insert_ (tersimpan) sesudah pengajuan rumpun sukses divalidasi oleh Admin BAK S2. |

## Flow (Alur Kerja) Peminatan

1. **Administrasi (Admin BAK)**: Admin membuat/memastikan periode pengajuan Rumpun dibuka, serta meng-update daftar `mag_opsi_rumpun` dan `peminatan`.
2. **Pengajuan (Mahasiswa)**: Mahasiswa S2 yang sudah memenuhi kualifikasi SKS melakukan klik menu `Pengajuan -> Peminatan Rumpun Psikologi`.
3. **Validasi & Penataan**: Admin mengecek data, nilai masa persiapan, dsb. Jika _Acc_, data akan final ter-simpan pada `mag_pengelompokan_rumpun`.
4. **Keputusan Resmi**: Mahasiswa akan dilabeli sesuai rumpun pilihan untuk memandu alur tesis berikutnya.
