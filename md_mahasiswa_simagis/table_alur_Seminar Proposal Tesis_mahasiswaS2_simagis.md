# Alur Seminar Proposal Tesis dan Upload Revisi Mahasiswa S2 Simagis

Dokumen ini memetakan _flow_ (alur proses) pendaftaran, pelaksanaan, hingga upload revisi **Seminar Proposal Tesis (Sempro)** oleh Mahasiswa Magister (S2).

## Keterlibatan Peran (Roles)

- **Mahasiswa S2**: Mendaftar _Sempro_, mengikuti ujian, dan wajib upload perbaikan (Revisi) proposal pasca-ujian sesuai catatan penguji.
- **Dosen Penguji**: Mengisi nilai dan catatan (revisi) saat ujian, serta me-review dan memvalidasi perbaikan/revisi mahasiswa pasca-Sempro.
- **Admin BAK S2**: Membuka pendaftaran, mengecek persyaratan SKS/Berkas, membuat plotting Jadwal Ujian dan Ruangan, menerbitkan Berita Acara (BA), serta memproses nilai _grade_ mahasiswa pasca divalidasi.

## Tabel Database yang Terkait

| Nama Tabel                                  | Deskripsi Proses                                                                                                                                   |
| ------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------- |
| **_Tahap 1: Pendaftaran & Penjadwalan_**    |                                                                                                                                                    |
| `mag_periode_pendaftaran_sempro`            | Batas jadwal (_Start/End_) kapan mahasiswa S2 bisa mengisi formulir Sempro di Simagis.                                                             |
| `mag_peserta_sempro`                        | Database mahasiswa yang berhasil mendaftar (beserta judul proposalnya) setelah lolos seleksi berkas oleh Admin BAK.                                |
| `mag_jadwal_sempro`                         | Waktu spesifik, _link_ meeting / ruang fisik ujian Sempro, dan lampiran undangan Ujian Sempro yang dibuat Admin BAK S2.                            |
| `opsi_menguji_sempro_tesis`                 | Tabel referensi peran penguji (Misal: Ketua Penguji, Anggota, Penguji Tamu).                                                                       |
| `mag_opsi_cek_kehadiran_penguji`            | Data absensi (Hadir/Tidak Hadir) daftar penguji Sempro di plot jadwal terkait.                                                                     |
| **_Tahap 2: Penilaian & Penguji_**          |                                                                                                                                                    |
| `mag_nilai_sempro`                          | Menyimpan input (skor nominal/rubrik) dari masing-masing Dosen Penguji Sempro.                                                                     |
| `mag_grade_sempro`                          | Menyimpan rekapitulasi nilai huruf / _Grade_ Kelulusan (Contoh: _Lulus Tanpa Revisi_, _Revisi Minor_, _Mengulang_).                                |
| `mag_opsi_validasi_nilai_sempro`            | Opsi keterangan bahwa nilai sudah disahkan oleh Kaprodi / BAK agar bisa ter-_publish_ di portal mahasiswa secara _realtime_.                       |
| **_Tahap 3: Pasca Sempro (Upload Revisi)_** |                                                                                                                                                    |
| `mag_revisi_sempro`                         | Tabel krusial yang menampung rekaman perbaikan. Mahasiswa mengunggah _File_ (PDF) Dokumen Proposal Tesis yang _fixed_ hasil Sempro.                |
| `mag_opsi_validasi_revisi`                  | Persetujuan Dosen Penguji / Pembimbing bahwa revisi mahasiswa tersebut **Diterima**, sehingga syarat mengikuti Sidang/Tesis lanjutan bisa _clear_. |

## Flow (Alur Kerja) Sempro S2

1. **Pendaftaran (Mahasiswa)**: Membuka _Formulir Pendaftaran Sempro_ jika tabel `mag_periode_pendaftaran_sempro` aktif, lengkapi Data Diri (Data MHSSW S2 Terkait) dan Judul Tesis.
2. **Pengecekan (Admin BAK)**: Admin mencentang kelengkapan syarat form dan mendaftarkannya ke `mag_peserta_sempro`.
3. **Penjadwalan (Admin BAK)**: Admin mendaftarkan tempat, hari, jam ujian melalui tabel `mag_jadwal_sempro` serta mengalokasikan / mem-plotting daftar Dosen Penguji berlandaskan `opsi_menguji_sempro_tesis`.
4. **Sidang Berjalan (Penguji/Mahasiswa)**: Sidang Sempro berlangsung. Nilai kemudian dimasukan oleh Penguji atau Admin ke dalam form-grading Sempro (`mag_nilai_sempro`). Hasil lalu dikalkulasi ke dalam Grade rata-rata. (`mag_grade_sempro`).
5. **Cetak Surat Keterangan / Berita Acara**: Admin mencetak rincian validasi Sempro (`mag_opsi_validasi_nilai_sempro`) menjadi Berita Acara sidang.
6. **Upload Revisi Proposal (Mahasiswa)**: Berbekal Berita Acara & Catatan revisi Penguji, mahasiswa S2 mengakses `Pendaftaran -> Upload Revisi Seminar Proposal` _(formRevisiSempro)_ lalu melampirkan berkas terbaru yang akan mempopulasi tabel `mag_revisi_sempro`.
7. **_Approval_ Akhir (Dosen/Admin)**: Dosen/Bagian Akademik memverifikasi `mag_opsi_validasi_revisi`. Setelah valid, mahasiswa bisa lanjut jalan riset!
