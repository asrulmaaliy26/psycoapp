# 📋 Alur Pengajuan Dosen Pembimbing Skripsi (Dospem)

Dokumen ini menjelaskan alur lengkap proses pengajuan Dosen Pembimbing Skripsi (Dospem) bagi mahasiswa S1 dalam sistem `psychoApps/`. Proses ini merupakan **gerbang utama** sebelum mahasiswa bisa mendaftar Seminar Proposal dan Ujian Skripsi.

---

## 👥 AKTOR YANG TERLIBAT

| Aktor         | Peran                                                                                          |
| ------------- | ---------------------------------------------------------------------------------------------- |
| **Mahasiswa** | Mengajukan, mengisi form, upload berkas, memilih calon Dospem                                  |
| **Admin BAK S1 BAK S1** | Membuka periode, mengelola daftar dosen, memverifikasi pengajuan, mengonfirmasi Dospem & judul |
| **Sistem**    | Mengecek kuota dospem, validasi syarat, menolak otomatis jika kuota penuh                      |

---

## 🖼️ GAMBARAN ALUR KESELURUHAN

```
[ADMIN BAK S1] Siapkan Daftar Dosen & Kuota
        ↓
[ADMIN BAK S1] Buka Periode Pengajuan
        ↓
[MAHASISWA] Cek Syarat Otomatis
        ↓ (jika lolos semua syarat)
[MAHASISWA] STEP 1 — Isi Data Judul & Peminatan
        ↓
[MAHASISWA] STEP 2 — Upload Berkas Pendukung
        ↓
[MAHASISWA] STEP 3 — Pilih Calon Dospem 1 & 2
        ↓ (sistem cek kuota)
[ADMIN BAK S1] Verifikasi Dospem 1     → ditolak / diterima (cek1)
[ADMIN BAK S1] Verifikasi Dospem 2     → ditolak / diterima (cek2)
[ADMIN BAK S1] Verifikasi Judul         → ditolak / diterima (cekjudul)
        ↓ (semua disetujui)
Mahasiswa mendapat Dospem Resmi (status = '2')
        ↓
Mahasiswa BISA mendaftar Seminar Proposal Skripsi ✅
```

---

## 🔐 SYARAT MAHASISWA SEBELUM BISA MENGAJUKAN

Dicek otomatis di `prePengajuanDospemUser.php`:

| No  | Syarat                                                  | Sumber Data                                     | Pesan Jika Gagal                                                |
| --- | ------------------------------------------------------- | ----------------------------------------------- | --------------------------------------------------------------- |
| 1   | **Biodata lengkap** (foto, alamat, data orang tua, dll) | `dt_mhssw`                                      | "Cek dan lengkapi isian biodata terlebih dahulu di menu Profil" |
| 2   | **Minimal semester 7** (gasal)                          | Dihitung: `(tahun_sekarang - angkatan) × 2`     | "Anda sekarang masih semester X"                                |
| 3   | **Minimal semester 7** (genap)                          | Dihitung: `(bulan ≤ 6) + 1 + (jarak tahun × 2)` | "Anda sekarang masih semester X"                                |
| 4   | **Periode pengajuan sedang aktif**                      | `pengajuan_dospem.status = '1'`                 | Form tidak tampil                                               |

---

## 📝 ALUR DETAIL STEP BY STEP

### PERSIAPAN ADMIN

**File:** `pngjnDospemAdm.php` + `dospemPerPeriodeAdm.php`

| Langkah                              | File PHP                            | Keterangan                                                              |
| ------------------------------------ | ----------------------------------- | ----------------------------------------------------------------------- |
| Admin BAK S1 set daftar dosen beserta kuota | `dospemPerPeriodeAdm.php`           | Input NIP, nama dosen, `kuota1` (sbg Dospem 1), `kuota2` (sbg Dospem 2) |
| Admin BAK S1 edit kuota dosen               | `editKuotaDospemAdm.php`            | Update `dospem_skripsi.kuota1` dan `kuota2`                             |
| Admin BAK S1 input periode baru             | `pngjnDospemAdm.php` → modal        | Set tahap, `start_datetime`, `end_datetime`, `syarat_sks`               |
| Admin BAK S1 aktifkan periode               | `updateStatusPeriodePengDospem.php` | Set `pengajuan_dospem.status = '1'`                                     |
| Admin BAK S1 edit periode                   | `editPeriodePengDospemAdm.php`      | Ubah tanggal dan SKS yang disyaratkan                                   |

**Tabel:** `dospem_skripsi` (daftar dosen + kuota), `pengajuan_dospem` (periode)

---

### STEP 1 — Mahasiswa: Isi Data Judul & Peminatan

**File:** `formPengajuanDospemUserSatu.php` → `sformPengajuanDospemUserSatu.php`

Form yang diisi:

- Judul skripsi (sementara)
- Peminatan/bidang skripsi
- Deskripsi singkat topik

**Proses di `sformPengajuanDospemUserSatu.php`:**

- `INSERT INTO pengelompokan_dospem_skripsi` dengan `nim`, `id_periode`, judul, peminatan
- Redirect ke halaman berikutnya

**Catatan:** Setelah submit, data masuk ke `pengelompokan_dospem_skripsi` dengan `status = '1'` (pending semua cek)

---

### STEP 2 — Mahasiswa: Upload Berkas Pendukung

**File:** `formPengajuanDospemUserDua.php` → `sformPengajuanDospemUserDua.php`

**Berkas yang wajib diupload (semua format PDF):**

| No  | Dokumen                           | Field di DB        |
| --- | --------------------------------- | ------------------ |
| 1   | Proposal skripsi                  | `file_prop`        |
| 2   | Transkrip nilai sementara         | `file_transkrip`   |
| 3   | Sertifikat TOEFL / TOAFL          | `file_toefl_toafl` |
| 4   | Sertifikat Tashih Al-Quran        | `file_tashih`      |
| 5   | Bukti pembayaran UKT semester ini | `file_ukt`         |

**Proses:** `UPDATE pengelompokan_dospem_skripsi SET file_prop=..., file_transkrip=..., ...`

---

### STEP 3 — Mahasiswa: Pilih Calon Dospem 1 & 2

**File:** `formPengajuanDospemUserTiga.php` → `sformPengajuanDospemUserTiga.php`

**Validasi sistem otomatis sebelum disimpan:**

| Kondisi Gagal                                    | Pesan                             | Redirect                      |
| ------------------------------------------------ | --------------------------------- | ----------------------------- |
| Kuota Dospem 1 penuh (`data1.jumData >= kuota1`) | Dospem 1 yang dipilih sudah penuh | `?message=notifGagalDospem1`  |
| Kuota Dospem 2 penuh (`data2.jumData >= kuota2`) | Dospem 2 yang dipilih sudah penuh | `?message=notifGagalDospem2`  |
| Keduanya penuh                                   | Kedua dospem penuh                | `?message=notifGagalDospem12` |
| Dospem 1 = Dospem 2 (sama)                       | Tidak boleh pilih dosen yang sama | `?message=notifGagalSama`     |

**Jika lolos semua validasi:**

```sql
UPDATE pengelompokan_dospem_skripsi
SET dospem_skripsi1='...', dospem_skripsi2='...'
WHERE id='...'
```

---

## ✅ PROSES VERIFIKASI OLEH ADMIN

Setelah mahasiswa selesai 3 langkah, admin melakukan **3 verifikasi terpisah**:

**Dashboard Admin:** `pngjnDospemPerPeriodeAdm.php`

### Verifikasi Dospem 1 (`cek1`)

| File Admin BAK S1                                               | Fungsi                                                 |
| -------------------------------------------------------- | ------------------------------------------------------ |
| `verdossatuPendingAdm.php` `perDospemSatuPendingAdm.php` | Lihat yang belum diverifikasi (`cek1 = '1'`)           |
| `verdossatuSelesaiAdm.php` `perDospemSatuSelesaiAdm.php` | Lihat yang sudah diverifikasi (`cek1 != '1'`)          |
| `verifikasiDos1Adm.php`                                  | Update `cek1 = '2'` (setuju) atau `cek1 = '3'` (tolak) |

### Verifikasi Dospem 2 (`cek2`)

| File Admin BAK S1                                             | Fungsi                        |
| ------------------------------------------------------ | ----------------------------- |
| `verdosduaPendingAdm.php` `perDospemDuaPendingAdm.php` | Lihat pending (`cek2 = '1'`)  |
| `verdosduaSelesaiAdm.php` `perDospemDuaSelesaiAdm.php` | Lihat selesai (`cek2 != '1'`) |
| `verifikasiDos2Adm.php`                                | Update `cek2`                 |

### Verifikasi Judul Skripsi (`cekjudul`)

| File Admin BAK S1               | Fungsi                                                         |
| ------------------------ | -------------------------------------------------------------- |
| `verjudulPendingAdm.php` | Lihat judul yang belum diverifikasi                            |
| `verjudulSelesaiAdm.php` | Lihat judul yang sudah diverifikasi                            |
| `verifikasiJudulAdm.php` | Update `cekjudul = '2'` (setuju) atau `cekjudul = '3'` (tolak) |

---

### Status Akhir Pengajuan

| Field      | Nilai `'1'`           | Nilai `'2'`                    | Nilai `'3'`         |
| ---------- | --------------------- | ------------------------------ | ------------------- |
| `cek1`     | Pending (belum dicek) | ✅ Dospem 1 disetujui          | ❌ Dospem 1 ditolak |
| `cek2`     | Pending (belum dicek) | ✅ Dospem 2 disetujui          | ❌ Dospem 2 ditolak |
| `cekjudul` | Pending (belum dicek) | ✅ Judul disetujui             | ❌ Judul ditolak    |
| `status`   | Belum dikonfirmasi    | ✅ **Dospem resmi ditetapkan** | —                   |

> **Status `= '2'` pada field `status`** di tabel `pengelompokan_dospem_skripsi` adalah kunci utama agar mahasiswa bisa mendaftar Sempro dan Ujian Skripsi.

---

## 📊 DASHBOARD REKAP DI ADMIN

Semua pengajuan bisa dipantau oleh admin:

| File                                | Fungsi                                                      |
| ----------------------------------- | ----------------------------------------------------------- |
| `pngjnDospemAdm.php`                | Dashboard utama: lihat semua periode + statistik verifikasi |
| `allPengDospemPerPeriodeAdm.php`    | Semua pengajuan dalam 1 periode                             |
| `pngjnDospemPerPeriodeAdm.php`      | Verifikasi pengajuan per periode                            |
| `rekapDospemAdm.php`                | Rekap semua periode (lintas tahun)                          |
| `rekapDospemPerPeriodeAdm.php`      | Rekap per periode                                           |
| `detailPerPengDospemAdm.php`        | Detail per mahasiswa                                        |
| `sformInputDospemPerPeriodeAdm.php` | Input dospem oleh admin (manual)                            |
| `imporPengajuanDospemAdm.php`       | **Impor massal dari Excel**                                 |
| `eksporPengajuanDospemAdm.php`      | **Ekspor ke Excel**                                         |
| `cetakPengajuanDospemAdm.php`       | **Cetak rekap Dospem PDF**                                  |
| `cetakAllDataDospemAdm.php`         | Cetak semua data dospem                                     |

---

## ✏️ EDIT & HAPUS OLEH MAHASISWA

Mahasiswa dapat mengedit pengajuan **sebelum diverifikasi**:

| File                               | Fungsi                                                  |
| ---------------------------------- | ------------------------------------------------------- |
| `editPengajuanDospemUser.php`      | Edit semua data pengajuan                               |
| `editPengajuanDospemUserSatu.php`  | Edit data judul (Step 1)                                |
| `editPengajuanDospemUserDua.php`   | Edit upload berkas (Step 2)                             |
| `editPengajuanDospemUserTiga*.php` | Edit pilihan dospem (Step 3) — ada varian Satu s/d Lima |
| `deletePengajuanDospemUser.php`    | Hapus pengajuan (sebelum diverifikasi)                  |
| `riwayatPengajuanDospemUser.php`   | Lihat status & riwayat pengajuan                        |

---

## 🗃️ STRUKTUR TABEL DATABASE

### Tabel `pengajuan_dospem` (Periode)

| Kolom            | Tipe     | Keterangan                          |
| ---------------- | -------- | ----------------------------------- |
| `id`             | INT      | Primary key                         |
| `ta`             | INT      | FK → `dt_ta.id` (Tahun Akademik)    |
| `tahap`          | INT      | FK → `opsi_tahap_ujprop_ujskrip.id` |
| `start_datetime` | DATETIME | Tanggal buka pengajuan              |
| `end_datetime`   | DATETIME | Tanggal tutup pengajuan             |
| `syarat_sks`     | INT      | SKS minimal yang harus ditempuh     |
| `status`         | TINYINT  | `1` = aktif, lainnya = tidak aktif  |

### Tabel `pengelompokan_dospem_skripsi` (Data Pengajuan Mahasiswa)

| Kolom              | Tipe    | Keterangan                         |
| ------------------ | ------- | ---------------------------------- |
| `id`               | INT     | Primary key                        |
| `nim`              | VARCHAR | NIM mahasiswa                      |
| `id_periode`       | INT     | FK → `pengajuan_dospem.id`         |
| `judul`            | TEXT    | Judul skripsi yang diajukan        |
| `peminatan`        | VARCHAR | Bidang peminatan                   |
| `file_prop`        | VARCHAR | Path file proposal (PDF)           |
| `file_transkrip`   | VARCHAR | Path file transkrip (PDF)          |
| `file_toefl_toafl` | VARCHAR | Path file TOEFL/TOAFL (PDF)        |
| `file_tashih`      | VARCHAR | Path file tashih Al-Quran (PDF)    |
| `file_ukt`         | VARCHAR | Path bukti UKT (PDF)               |
| `dospem_skripsi1`  | VARCHAR | NIP calon Dospem 1                 |
| `dospem_skripsi2`  | VARCHAR | NIP calon Dospem 2                 |
| `cek1`             | CHAR    | Status verifikasi Dospem 1         |
| `cek2`             | CHAR    | Status verifikasi Dospem 2         |
| `cekjudul`         | CHAR    | Status verifikasi Judul            |
| `status`           | CHAR    | `'2'` = Dospem resmi terkonfirmasi |

### Tabel `dospem_skripsi` (Daftar Dosen & Kuota)

| Kolom        | Tipe    | Keterangan                                              |
| ------------ | ------- | ------------------------------------------------------- |
| `id`         | INT     | Primary key                                             |
| `id_periode` | INT     | FK → `pengajuan_dospem.id`                              |
| `nip`        | VARCHAR | NIP dosen                                               |
| `kuota1`     | INT     | Maks mahasiswa sbg Dospem **1** (Pembimbing Utama)      |
| `kuota2`     | INT     | Maks mahasiswa sbg Dospem **2** (Pembimbing Pendamping) |

---

## ⚡ VALIDASI KUOTA OTOMATIS OLEH SISTEM

Di `sformPengajuanDospemUserTiga.php`, sistem mengecek kuota secara real-time sebelum menyimpan pilihan dosen:

```
Hitung berapa mahasiswa yang sudah memilih Dospem X dalam periode ini
dengan status='1' (pending/aktif)
    ↓
Bandingkan dengan kuota1/kuota2 yang ditetapkan admin
    ↓
Jika penuh → TOLAK otomatis
Jika masih ada slot → SIMPAN pilihan
```

---

## 🔵 FLAG STATUS KUNCI

| Field                     | Nilai | Arti                      | Dampak                          |
| ------------------------- | ----- | ------------------------- | ------------------------------- |
| `pengajuan_dospem.status` | `'1'` | Periode **aktif**         | Form pengajuan terbuka          |
| `pengelompokan.status`    | `'1'` | Pengajuan **belum final** | Belum bisa daftar Sempro        |
| `pengelompokan.status`    | `'2'` | Dospem **terkonfirmasi**  | ✅ Bisa daftar Sempro & Ujskrip |
| `cek1`                    | `'1'` | Dospem 1 **pending**      | Menunggu verifikasi admin       |
| `cek1`                    | `'2'` | Dospem 1 **diterima**     | —                               |
| `cek1`                    | `'3'` | Dospem 1 **ditolak**      | Mahasiswa harus ganti pilihan   |
| `cek2`                    | `'2'` | Dospem 2 **diterima**     | —                               |
| `cekjudul`                | `'2'` | Judul **diterima**        | —                               |

> **Syarat Daftar Sempro & Ujian Skripsi:**  
> `pengelompokan_dospem_skripsi.status = '2'` harus terpenuhi.

---

_Dokumen ini dibuat berdasarkan analisis source code proyek psycoapp._  
_Dibuat: 2026-03-05_
