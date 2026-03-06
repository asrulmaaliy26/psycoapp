# 📘 Alur Tugas Akhir — Sistem Psikologi Apps

Dokumen ini menjelaskan alur lengkap proses Tugas Akhir (Skripsi S1 dan Tesis S2) dalam sistem `psycoapp`, mencakup peran Mahasiswa, Admin, dan Dosen.

> Proyek ini terdiri dari dua modul:
>
> - **`psychoApps/`** → untuk mahasiswa **S1 (Skripsi)**
> - **`simagis/`** → untuk mahasiswa **S2 Magister (Tesis)**

---

## ═══════════════════════════════════

## 🎓 JALUR S1 — SKRIPSI

## ═══════════════════════════════════

### Gambaran Urutan Proses S1

```
1. PKL (Praktik Kerja Lapangan)
        ↓
2. Pengajuan Dosen Pembimbing Skripsi
        ↓
3. Seminar Proposal Skripsi (Sempro)
        ↓
4. Ujian Komprehensif (Kompre)
        ↓
5. Ujian Skripsi
        ↓
6. LULUS ✅
```

---

### TAHAP 1 — PKL (Praktik Kerja Lapangan)

**Aktor:** Mahasiswa, Admin, Dosen Pembimbing Lapangan (DPL)

| Langkah                | Aktor     | File PHP                         | Keterangan              |
| ---------------------- | --------- | -------------------------------- | ----------------------- |
| Admin BAK S1 buka periode PKL | Admin BAK S1     | `editPeriodePendPklAdm.php`      | Set tanggal buka/tutup  |
| Mahasiswa daftar PKL   | Mahasiswa | `formPendaftaranPklUserSatu.php` | Isi data tempat PKL     |
| Upload berkas          | Mahasiswa | `formPendaftaranPklUserDua.php`  | Upload surat, transkrip |
| Admin BAK S1 verifikasi       | Admin BAK S1     | `verpesPklPerPeriodeAdm.php`     | Terima / Tolak          |
| Admin BAK S1 assign DPL       | Admin BAK S1     | `inputDplPesertaPklAdm.php`      | Tentukan DPL            |
| Pelaksanaan PKL        | Mahasiswa | —                                | Di lapangan             |
| Admin BAK S1 input nilai      | Admin BAK S1     | `inputNilaiPesertaPklAdm.php`    | Nilai dari DPL          |
| Mahasiswa lihat hasil  | Mahasiswa | `riwayatPendaftaranPklUser.php`  | Lihat nilai PKL         |

**Tabel database:** `pendaftaran_pkl`, `peserta_pkl`, `dpl_pkl`, `grade_pkl`, `nilai_pkl`

**Syarat lulus PKL:** nilai berada di range `grade_pkl.db` s/d `grade_pkl.dt`

---

### TAHAP 2 — Pengajuan Dosen Pembimbing Skripsi

**Aktor:** Mahasiswa, Admin BAK S1

**Syarat bisa mengajukan:**

- ✅ Biodata lengkap di `dt_mhssw` (foto, alamat, data orang tua, dll)
- ✅ Minimal semester **7** (dihitung dari angkatan vs tahun sekarang)

| Langkah                              | Aktor     | File PHP                          | Keterangan                |
| ------------------------------------ | --------- | --------------------------------- | ------------------------- |
| Admin BAK S1 buka periode                   | Admin BAK S1     | `pngjnDospemAdm.php`              | Set waktu pengajuan       |
| Mahasiswa isi judul + dospem pilihan | Mahasiswa | `formPengajuanDospemUserSatu.php` | Judul skripsi & peminatan |
| Mahasiswa upload proposal awal       | Mahasiswa | `formPengajuanDospemUserDua.php`  | File PDF                  |
| Mahasiswa pilih Dospem               | Mahasiswa | `formPengajuanDospemUserTiga.php` | Pilih calon pembimbing 1  |
| Admin BAK S1 verifikasi berkas              | Admin BAK S1     | `verifikasiPengDospemAdm.php`     | Cek kelengkapan           |
| Admin BAK S1 validasi judul                 | Admin BAK S1     | `updateVerJudPengDospemAdm.php`   | Setujui/tolak judul       |
| Admin BAK S1 konfirmasi Dospem 1 & 2        | Admin BAK S1     | `updateVerPengDospem1Adm.php`     | Assign pembimbing resmi   |
| Mahasiswa lihat riwayat              | Mahasiswa | `riwayatPengajuanDospemUser.php`  | Status pengajuan          |

**Tabel database:** `pengajuan_dospem`, `pengelompokan_dospem_skripsi`

**Flag status penting:**

- `status = '2'` → Dospem **sudah dikonfirmasi** (syarat sempro & ujskrip)
- `status = '1'` → Menunggu konfirmasi

---

### TAHAP 3 — Seminar Proposal Skripsi (Sempro)

**Aktor:** Mahasiswa, Admin, Dosen Penguji

**Syarat bisa mendaftar:**

- ✅ Biodata lengkap
- ✅ Minimal semester **7**
- ✅ Dosen Pembimbing Skripsi **sudah dikonfirmasi** (`status = '2'`)
- ✅ Sudah **LULUS PKL** (nilai PKL tidak di range "tidak lulus")

| Langkah                              | Aktor     | File PHP                                | Keterangan                       |
| ------------------------------------ | --------- | --------------------------------------- | -------------------------------- |
| Admin BAK S1 buka periode                   | Admin BAK S1     | `editPeriodePendSemproAdm.php`          | Set tanggal + tahap              |
| Mahasiswa isi form + upload proposal | Mahasiswa | `formPendaftaranSemproUserSatu/Dua.php` | Data pendaftaran & file          |
| Admin BAK S1 verifikasi pendaftaran         | Admin BAK S1     | `verPndftrSemproAdm.php`                | Terima / Tolak + catatan         |
| Admin BAK S1 input jadwal Sempro            | Admin BAK S1     | `inputJadSemproPerPeriodeAdm.php`       | Tentukan tanggal, ruang, penguji |
| Admin BAK S1 assign Penguji 1 & 2           | Admin BAK S1     | `inputJadSemproPerPeriodePerPesAdm.php` | 2 dosen penguji                  |
| Mahasiswa cetak jadwal               | Mahasiswa | `cetakJadwalSemproPerPeriodeUser.php`   | Bukti jadwal                     |
| **[HARI H] Pelaksanaan Sempro**      | —         | —                                       | —                                |
| Penguji isi berita acara             | Dosen     | `baSemproSkripsiPenguji1/2.php`         | Catatan & penilaian              |
| Admin BAK S1 input nilai penguji 1 & 2      | Admin BAK S1     | `nilaiSemproPenguji1/2...Adm.php`       | Input nilai per aspek            |
| Hitung rata-rata nilai               | Sistem    | `meanNilaiNarsum1/2Sempro.php`          | Otomatis                         |
| Admin BAK S1 validasi nilai                 | Admin BAK S1     | `rekapNilaiSemproAdm.php`               | Konfirmasi nilai final           |
| Mahasiswa lihat hasil                | Mahasiswa | `riwayatPendaftaranSemproUser.php`      | Lulus / Sempro Ulang             |

**Tabel database:** `pendaftaran_sempro`, `peserta_sempro`, `jadwal_sempro`, `nilai_sempro`, `grade_sempro`

**Hasil:**

- **Lulus** → lanjut ke tahap berikutnya
- **Seminar Ulang** → nilai di range `grade_sempro.sub` – `grade_sempro.sut`

---

### TAHAP 4 — Ujian Komprehensif (Kompre)

**Aktor:** Mahasiswa, Admin, Pengawas

**Syarat bisa mendaftar:**

- ✅ Biodata lengkap, minimal semester 7
- ✅ Dospem dikonfirmasi
- ✅ Lulus PKL

| Langkah                         | Aktor     | File PHP                                | Keterangan                 |
| ------------------------------- | --------- | --------------------------------------- | -------------------------- |
| Admin BAK S1 buka periode              | Admin BAK S1     | `editPeriodePendKompreAdm.php`          | Set jadwal kompre          |
| Mahasiswa daftar                | Mahasiswa | `formPendaftaranKompreUserSatu/Dua.php` | Upload KHS, transkrip, dll |
| Admin BAK S1 verifikasi                | Admin BAK S1     | `verkomprePendingAdm.php`               | Terima / Tolak             |
| Admin BAK S1 buat jadwal kompre        | Admin BAK S1     | `jadKomprePerPeriodeAdm.php`            | Ruang, waktu, pengawas     |
| Admin BAK S1 assign pengawas           | Admin BAK S1     | `editPengawasKompreAdm.php`             | Dosen pengawas             |
| Mahasiswa cetak jadwal          | Mahasiswa | `cetakJadwalKomprePerPeriodeUser.php`   | —                          |
| **[HARI H] Pelaksanaan Kompre** | —         | —                                       | Ujian tulis/lisan          |
| Admin BAK S1 input nilai               | Admin BAK S1     | `inputNilaiPesertaKompreAdm.php`        | `hasil_ujian`              |
| Admin BAK S1 validasi                  | Admin BAK S1     | `verpesKomprePerPeriodeAdm.php`         | Konfirmasi nilai           |
| Mahasiswa lihat hasil           | Mahasiswa | `riwayatPendaftaranUjianKompreUser.php` | Lulus / Tidak              |

**Tabel database:** `pendaftaran_kompre`, `peserta_kompre`, `jadwal_kompre`, `grade_kompre`, `dt_pengawas_kompre`

---

### TAHAP 5 — Ujian Skripsi

**Aktor:** Mahasiswa, Admin, Dosen (Ketua, Sekretaris, Penguji Utama)

**Syarat bisa mendaftar (paling ketat):**

- ✅ Biodata lengkap, minimal semester 7
- ✅ Dospem **dikonfirmasi** (`status = '2'`)
- ✅ **Lulus PKL** — nilai tidak di range tidak lulus
- ✅ **Lulus Sempro** — nilai tidak di range sempro ulang
- ✅ **Lulus Kompre** — nilai tidak di range tidak lulus
- ✅ **SKKM sudah diisi** (`skkm` tabel tidak kosong)

| Langkah                                | Aktor     | File PHP                                                                                     | Keterangan               |
| -------------------------------------- | --------- | -------------------------------------------------------------------------------------------- | ------------------------ |
| Admin BAK S1 buka periode ujskrip             | Admin BAK S1     | `editPeriodePendUjskripAdm.php`                                                              | Set tanggal              |
| Mahasiswa isi form                     | Mahasiswa | `formPendaftaranUjskripUserSatu.php`                                                         | Data pendaftaran         |
| Mahasiswa upload skripsi               | Mahasiswa | `formPendaftaranUjskripUserDua.php`                                                          | File skripsi PDF         |
| Admin BAK S1 verifikasi                       | Admin BAK S1     | `verPndftrUjskripAdm.php`                                                                    | Terima / Tolak           |
| Admin BAK S1 buat jadwal ujian                | Admin BAK S1     | `inputJadUjskripPerPeriodeAdm.php`                                                           | Tanggal, ruang           |
| Admin BAK S1 assign 3 penguji                 | Admin BAK S1     | `inputJadUjskripPerPeriodePerPesAdm.php`                                                     | Ketua, Sekretaris, Utama |
| Mahasiswa cetak jadwal                 | Mahasiswa | `cetakJadwalUjskripPerPeriodeUser.php`                                                       | —                        |
| Mahasiswa cetak berkas lengkap         | Mahasiswa | `cetakPujskripUser.php`                                                                      | Semua dokumen ujian      |
| **[HARI H] Pelaksanaan Ujian Skripsi** | —         | —                                                                                            | —                        |
| Dosen Ketua isi BA                     | Dosen     | `baUjskripKetua.php` (10 item)                                                               | Berita acara             |
| Dosen Sekretaris isi BA                | Dosen     | `baUjskripSekretaris.php`                                                                    | Berita acara             |
| Dosen Utama isi BA                     | Dosen     | `baUjskripUtama.php`                                                                         | Berita acara             |
| Hitung nilai rata-rata                 | Sistem    | `meanNilaiKetuaUjskrip.php` + `meanNilaiUtamaUjskrip.php` + `meanNilaiSekretarisUjskrip.php` | Per peran                |
| Hitung nilai final                     | Sistem    | `meanNilaiUjskrip.php`                                                                       | Nilai akhir              |
| Admin BAK S1 validasi nilai                   | Admin BAK S1     | `rekapNilaiUjskripAdm.php`                                                                   | Konfirmasi nilai         |
| Mahasiswa lihat hasil                  | Mahasiswa | `riwayatPendaftaranUjianSkripsiUser.php`                                                     | LULUS ✅                 |

**Tabel database:** `pendaftaran_skripsi`, `peserta_ujskrip`, `jadwal_ujskrip`, `nilai_ujskrip`, `grade_ujskrip`

---

## ═══════════════════════════════════

## 🎓 JALUR S2 — TESIS (MAGISTER)

## ═══════════════════════════════════

### Gambaran Urutan Proses S2

```
1. Pengajuan Pembimbing Tesis (PPT)
        ↓
2. Bimbingan & Persetujuan Judul
        ↓
3. Seminar Proposal Tesis
        ↓
4. Upload Revisi Proposal
        ↓
5. Ujian Tesis
        ↓
6. Upload Revisi Tesis
        ↓
7. LULUS ✅
```

---

### TAHAP 1 — Pengajuan Pembimbing Tesis (PPT)

**Syarat:**

- ✅ Biodata S2 lengkap (`mag_dt_mhssw_pasca`)
- ✅ Sudah mengisi topik penelitian (Variabel X/Y, mediator, moderator)

| Langkah                           | Aktor     | File PHP                          | Keterangan             |
| --------------------------------- | --------- | --------------------------------- | ---------------------- |
| Admin BAK S2 buka periode PPT            | Admin BAK S2     | `simagis/editPeriodePptAdm.php`   | —                      |
| Mahasiswa isi pengajuan PPT 1     | Mahasiswa | `simagis/formPengajuanPt.php`     | Judul + dospem pilihan |
| Mahasiswa isi pengajuan PPT 2     | Mahasiswa | `simagis/formPengajuanPt.php`     | Pembimbing alternatif  |
| Admin BAK S2 verifikasi                  | Admin BAK S2     | `simagis/verifikasiEditPpt.php`   | Setujui / Tolak        |
| Admin BAK S2 konfirmasi Pembimbing 1 & 2 | Admin BAK S2     | `simagis/updateVerifikasiPpt.php` | `cek1=2`, `cek2=2`     |
| Admin BAK S2 konfirmasi judul            | Admin BAK S2     | `simagis/updateVerifikasiPpt.php` | `cekjudul=2`           |

**Tabel database:** `mag_pengelompokan_dospem_tesis`, `mag_periode_pendaftaran_ujtes`

**Flag penting:**

- `cek1='2'` = Pembimbing 1 dikonfirmasi
- `cek2='2'` = Pembimbing 2 dikonfirmasi
- `cekjudul='2'` = Judul tesis dikonfirmasi
- Ketiganya **harus** bernilai `'2'` untuk bisa daftar Sempro & Ujian Tesis

---

### TAHAP 2 — Seminar Proposal Tesis

**Syarat:**

- ✅ Biodata S2 lengkap
- ✅ `cek1=2`, `cek2=2`, `cekjudul=2` (kedua pembimbing & judul disetujui)
- ✅ Status mahasiswa belum lulus

| Langkah                               | Aktor     | File PHP                                      | Keterangan             |
| ------------------------------------- | --------- | --------------------------------------------- | ---------------------- |
| Admin BAK S2 buka periode                    | Admin BAK S2     | `simagis/editPeriodePendSemproAdm.php`        | Set tanggal            |
| Mahasiswa isi form sempro             | Mahasiswa | `simagis/formPendSempro.php`                  | Upload file proposal   |
| Admin BAK S2 lihat pendaftar                 | Admin BAK S2     | `simagis/pendaftarSemproPerPeriode.php`       | Daftar semua pendaftar |
| Admin BAK S2 buat jadwal                     | Admin BAK S2     | `simagis/includeInputJadSemproPerPeriode.php` | Tanggal, ruang         |
| Admin BAK S2 assign 2-4 penguji              | Admin BAK S2     | —                                             | Penguji 1, 2, 3, 4     |
| Mahasiswa cetak jadwal                | Mahasiswa | `simagis/cetakJadwalSempro.php`               | —                      |
| **[HARI H] Pelaksanaan Sempro Tesis** | —         | —                                             | —                      |
| Dosen cek kehadiran                   | Dosen     | `simagis/cekKehadiranPengujiSempro.php`       | Konfirmasi hadir       |
| Dosen isi berita acara (tiap penguji) | Dosen     | `simagis/baSemproTesisPenguji1/2/3/4.php`     | 4 penguji × 1 BA       |
| Dosen input penilaian                 | Dosen     | `simagis/formPenilaianSemproPerPeriode.php`   | Nilai per penguji      |
| Hitung nilai rata-rata                | Sistem    | `simagis/meanNilaiPenguji1-4SemproTes.php`    | Per penguji            |
| Hitung nilai final                    | Sistem    | `simagis/meanNilaiSemproTes.php`              | Nilai akhir            |
| Admin BAK S2 validasi nilai                  | Admin BAK S2     | `simagis/updateValidasiPenilaianSempro.php`   | `validasi = '2'`       |
| Mahasiswa lihat hasil                 | Mahasiswa | `simagis/includeRekapSemproUser.php`          | Lulus / Sempro Ulang   |

**Tabel database:** `mag_periode_pendaftaran_sempro`, `mag_peserta_sempro`, `mag_jadwal_sempro`, `mag_nilai_sempro`, `mag_grade_sempro`

**Hasil nilai:**

- **Lulus** → lanjut ke revisi proposal
- **Seminar Ulang** → nilai di range `mag_grade_sempro.sub` – `mag_grade_sempro.sut`

---

### TAHAP 3 — Upload Revisi Proposal Tesis

**Syarat:**

- ✅ Sudah mengikuti Sempro
- ✅ Nilai Sempro sudah divalidasi admin

| Langkah                 | Aktor     | File PHP                              | Keterangan                         |
| ----------------------- | --------- | ------------------------------------- | ---------------------------------- |
| Mahasiswa upload revisi | Mahasiswa | `simagis/formRevisiSempro.php`        | File revisi PDF                    |
| Admin BAK S2 validasi revisi   | Admin BAK S2     | `simagis/updateValidasiRevisiPro.php` | Terima (`cek=2`) / Tolak (`cek=3`) |

**Tabel database:** `mag_revisi_sempro`

---

### TAHAP 4 — Ujian Tesis

**Syarat (paling ketat, 7 kondisi):**

- ✅ Biodata S2 lengkap
- ✅ Kedua pembimbing & judul dikonfirmasi (`cek1=2, cek2=2, cekjudul=2`)
- ✅ Tidak berstatus sudah lulus
- ✅ **Sudah mengikuti Sempro Tesis** (ada di `mag_nilai_sempro`)
- ✅ Nilai Sempro **sudah divalidasi** admin (`validasi != '1'`)
- ✅ Nilai Sempro **bukan Seminar Ulang**
- ✅ **Sudah upload revisi proposal** (`mag_revisi_sempro`) dan **divalidasi** (`cek = '2'`)

| Langkah                                            | Aktor     | File PHP                                     | Keterangan                                                        |
| -------------------------------------------------- | --------- | -------------------------------------------- | ----------------------------------------------------------------- |
| Admin BAK S2 buka periode                                 | Admin BAK S2     | `simagis/editPeriodePendUjtesAdm.php`        | Set tanggal ujian tesis                                           |
| Mahasiswa isi form ujian tesis                     | Mahasiswa | `simagis/formPendUjTes.php`                  | Upload: tesis, kwitansi, transkrip, TOEFL/TOAFL, Turnitin, jurnal |
| Admin BAK S2 lihat pendaftar                              | Admin BAK S2     | `simagis/pendaftarUjtesPerPeriode.php`       | —                                                                 |
| Admin BAK S2 buat jadwal                                  | Admin BAK S2     | `simagis/includeInputJadUjtesPerPeriode.php` | —                                                                 |
| Admin BAK S2 assign 4 penguji                             | Admin BAK S2     | —                                            | Penguji 1, 2, 3, 4                                                |
| Mahasiswa cetak jadwal                             | Mahasiswa | `simagis/cetakJadwalUjtes.php`               | —                                                                 |
| **[HARI H] Pelaksanaan Ujian Tesis**               | —         | —                                            | —                                                                 |
| Dosen cek kehadiran                                | Dosen     | `simagis/cekKehadiranPengujiUjtes.php`       | —                                                                 |
| Dosen isi berita acara (**7 section per penguji**) | Dosen     | `simagis/ba1-7UjianTesisPenguji1/2/3/4.php`  | Total 28 file BA                                                  |
| Dosen input penilaian                              | Dosen     | `simagis/formPenilaianUjtesPerPeriode.php`   | —                                                                 |
| Hitung rata-rata                                   | Sistem    | `simagis/meanNilaiPenguji1-4UjTes.php`       | Per penguji                                                       |
| Hitung nilai final                                 | Sistem    | `simagis/meanNilaiUjTes.php`                 | Nilai akhir                                                       |
| Admin BAK S2 validasi nilai                               | Admin BAK S2     | `simagis/updateValidasiPenilaianUjtes.php`   | Konfirmasi                                                        |

**Tabel database:** `mag_periode_pendaftaran_ujtes`, `mag_peserta_ujtes`, `mag_jadwal_ujtes`, `mag_nilai_ujtes`, `mag_grade_ujtes`

---

### TAHAP 5 — Upload Revisi Tesis & LULUS

| Langkah                       | Aktor     | File PHP                              | Keterangan          |
| ----------------------------- | --------- | ------------------------------------- | ------------------- |
| Mahasiswa upload revisi tesis | Mahasiswa | `simagis/formRevisiTesis.php`         | File tesis final    |
| Admin BAK S2 validasi revisi tesis   | Admin BAK S2     | `simagis/updateValidasiRevisiTes.php` | Setujui / Tolak     |
| Mahasiswa dinyatakan LULUS    | Admin BAK S2     | `simagis/updateStatusMhssw.php`       | Update status = '2' |

---

## 📊 RINGKASAN PERBANDINGAN S1 vs S2

| Aspek                     | S1 Skripsi                                   | S2 Tesis                                                    |
| ------------------------- | -------------------------------------------- | ----------------------------------------------------------- |
| **Folder sistem**         | `psychoApps/`                                | `simagis/`                                                  |
| **Koneksi DB**            | `conAdm.php` / `conExt.php`                  | `koneksiAdm.php` / `koneksiUser.php`                        |
| **Jumlah tahap**          | 5 (PKL → Dospem → Sempro → Kompre → Ujskrip) | 5 (PPT → Sempro → Revisi Prop → Ujtes → Revisi Tesis)       |
| **Penguji Sempro**        | 2 penguji                                    | 2–4 penguji                                                 |
| **Penguji Ujian**         | 3 (Ketua, Sekretaris, Utama)                 | 4 penguji                                                   |
| **Berita Acara Ujian**    | 10 item × 3 peran                            | 7 section × 4 penguji (28 file)                             |
| **Revisi setelah ujian**  | Tidak ada                                    | Wajib (revisi proposal & revisi tesis)                      |
| **Syarat SKKM**           | ✅ Wajib diisi                               | ❌ Tidak ada                                                |
| **Syarat PKL**            | ✅ Wajib lulus                               | ❌ Tidak ada                                                |
| **Konfirmasi pembimbing** | `pengelompokan_dospem_skripsi.status = '2'`  | `mag_pengelompokan_dospem_tesis.cek1=2, cek2=2, cekjudul=2` |

---

## 🔑 FLAG / STATUS KUNCI DI DATABASE

| Flag                    | Nilai | Arti                                     |
| ----------------------- | ----- | ---------------------------------------- |
| `periode.status`        | `'1'` | Periode **sedang aktif/terbuka**         |
| `pengelompokan.status`  | `'2'` | Dospem **sudah dikonfirmasi** oleh admin |
| `mag_*.cek1 / cek2`     | `'2'` | Pembimbing 1/2 **sudah setuju**          |
| `mag_*.cekjudul`        | `'2'` | Judul **sudah disetujui**                |
| `nilai_sempro.validasi` | `'2'` | Nilai **sudah divalidasi** admin         |
| `revisi.cek`            | `'1'` | Menunggu validasi                        |
| `revisi.cek`            | `'2'` | **Diterima** admin                       |
| `revisi.cek`            | `'3'` | **Ditolak** → harus upload ulang         |
| `mag_mhssw.status`      | `'2'` | Mahasiswa **sudah lulus**                |

---

_Dokumen ini dibuat otomatis berdasarkan analisis source code proyek psycoapp._
_Dibuat: 2026-03-05_
