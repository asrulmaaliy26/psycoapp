# Alur Pengajuan Dosen Pembimbing Tesis Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ (alur proses) pengajuan, pemilihan, hingga verifikasi Dosen Pembimbing Tesis (PT) oleh Mahasiswa Magister (S2).

## Keterlibatan Peran (Roles)

- **Mahasiswa S2**: Membuat entri usulan pembimbing berdasar draft rancangan tesis dan peminatan prodi.
- **Admin BAK S2 / Kaprodi**: Mengesahkan periode pengajuan PT, memantau plotting/rasio bimbingan, verifikasi calon dospem, dan mem-publish hasil SK penetapan dospem Tesis.
- **Dosen Pembimbing Tesis**: Mendelegasikan persetujuan, membaca draf mahasiswa, serta siap membimbing pasca diverifikasi sistem.

## Tabel Database yang Terkait

| Nama Tabel                             | Deskripsi                                                                                                                                 | Perubahan (Dampak Transaksi)                                                                             |
| -------------------------------------- | ----------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------- |
| `mag_periode_pengajuan_dospem`         | Periode waktu kapan pengisian _form_ Dosen Pembimbing dapat diakses oleh mahasiswa.                                                       | Dikontrol/Buka-Tutup oleh Admin BAK/KaProdi.                                                             |
| `mag_dospem_tesis`                     | Repositori/Daftar pustaka list Dosen Pembimbing Tesis yang punya profil/keahlian tertentu.                                                | Referensi _Dropdown_.                                                                                    |
| `mag_opsi_verifikasi_pengajuan_dospem` | Master rujukan status verifikasi sebuah pengajuan Dospem PT (Contoh: _Belum Diperiksa_, _Diterima Ketua Program_, _Revisi Pilihan_, dll). | Referensi label sistem.                                                                                  |
| `mag_pengelompokan_dospem_tesis`       | Tabel inti yang menyimpan pendaftaran Pembimbing Tesis dari setiap Mahasiswa, dan melacak Status verifikasi akhir.                        | Ditambah ketika Mhs mengajukan (_formPengajuanPt_). Diganti _status-val_ saat di-Acc oleh Admin KaProdi. |

## Flow (Alur Kerja) Pengajuan Dospem

1. **Set Jadwal (Admin BAK S2)**: Admin BAK mengatur _timeline_ pengajuan pada database melalui input ke `mag_periode_pengajuan_dospem`.
2. **Form Pengajuan (Mahasiswa)**: Memilih menu _Pengajuan -> Pembimbing Tesis_ pada SIMAGIS. Mahasiswa menge-klik usulan (biasanya bisa 2 pilihan/kombinasi Utama & Pendamping) berdasar riwayat riset dosen (`mag_dospem_tesis`).
3. **Ploting (Kaprodi & Admin BAK)**: Program Studi (S2) dan Admin memverifikasi kapasitas/kuota bimbingan pada setiap dosen, mencocokan rumpun tesis Mahasiswa.
4. **Validasi SK**: Menambahkan kode validasi dari `mag_opsi_verifikasi_pengajuan_dospem` (contoh: _Terima Utama_, _Pindah ke Pendamping_). Data fix direkam dan terkunci di `mag_pengelompokan_dospem_tesis`.
5. **Pengumuman**: Dashboard ter-update otomatis. Mahasiswa kini tahu Dosen Pembimbingnya secara definitif. Dosen pembimbing dapat memulai _Log-book_ Bimbingan mahasiswa tersebut.
