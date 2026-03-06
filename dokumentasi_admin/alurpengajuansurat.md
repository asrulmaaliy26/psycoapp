# 📮 Alur Pengajuan Surat — Sistem Psikologi Apps

Dokumen ini menjelaskan seluruh alur pengajuan surat mahasiswa dalam sistem `psychoApps/`, mencakup 12 jenis surat, status alur, aktor yang terlibat, file PHP, dan tabel database.

---

## 🗂️ DAFTAR JENIS SURAT

Mahasiswa dapat mengajukan **12 jenis surat** melalui menu **Permohonan Surat** (`permohonanSuratUser.php`):

| No  | Nama Surat                                     | Kode      | Tabel DB                       | Form User              |
| --- | ---------------------------------------------- | --------- | ------------------------------ | ---------------------- |
| 1   | Izin Observasi & Wawancara Matkul **Individu** | SIOWI     | `siow_individu`                | `formSiowiUser.php`    |
| 2   | Izin Observasi & Wawancara Matkul **Kelompok** | SIOWK     | `siow_kelompok`                | `formSiowkUser.php`    |
| 3   | Izin Praktikum Individu Testee **Mahasiswa**   | SIPRAKITM | `siprak_mahasiswa` (`jenis=1`) | `formSiprakimUser.php` |
| 4   | Izin Praktikum Individu Testee **Siswa**       | SIPRAKITS | `siprak_siswa` (`jenis=1`)     | `formSiprakisUser.php` |
| 5   | Izin Praktikum Kelompok Testee **Mahasiswa**   | SIPRAKKTM | `siprak_mahasiswa` (`jenis=2`) | `formSiprakkmUser.php` |
| 6   | Izin Praktikum Kelompok Testee **Siswa**       | SIPRAKKT  | `siprak_siswa` (`jenis=2`)     | `formSiprakksUser.php` |
| 7   | Izin Magang Mandiri **Individu**               | SIMAGI    | `magang` (`jenis=1`)           | `formSimagiUser.php`   |
| 8   | Izin Magang Mandiri **Kelompok**               | SIMAGK    | `magang` (`jenis=2`)           | `formSimagkUser.php`   |
| 9   | Izin Tempat PKL                                | SITP      | `sitp`                         | `formSitpUser.php`     |
| 10  | Izin Observasi Pra Skripsi                     | IOPS      | `prasips`                      | `formPraSipsUser.php`  |
| 11  | Izin Penelitian Skripsi                        | SIPS      | `sips`                         | `formSipsUser.php`     |
| 12  | Keterangan Kelakuan Baik                       | SKKB      | `skkb`                         | `formSkkbUser.php`     |

---

## 🔄 ALUR UMUM PENGAJUAN SURAT

Semua jenis surat mengikuti **pola alur yang sama**:

```
[MAHASISWA] Buka menu Permohonan Surat
    ↓
[MAHASISWA] Pilih jenis surat yang dibutuhkan
    ↓
[MAHASISWA] Isi Form & Submit
    → statusform = '1' (Pengajuan/Menunggu)
    ↓
[ADMIN TATA PERSURATAN] Menerima permohonan masuk
    ↓
[ADMIN TATA PERSURATAN] Proses surat (buat surat resmi)
    → statusform = '2' (Proses)
    ↓
[ADMIN TATA PERSURATAN] Kirim/selesaikan surat
    → statusform = '3' (Selesai)
    ↓
[MAHASISWA] Cetak surat
    ↓
─── ATAU ───
[ADMIN TATA PERSURATAN] Tolak permohonan
    → statusform = '4' (Ditolak)
```

### Status `statusform` di Database

| Nilai | Status        | Keterangan                                     |
| ----- | ------------- | ---------------------------------------------- |
| `'1'` | **Pengajuan** | Mahasiswa baru submit, menunggu diproses admin |
| `'2'` | **Proses**    | Admin Tata Persuratan sedang memproses/membuat surat           |
| `'3'` | **Selesai**   | Surat sudah selesai, mahasiswa bisa cetak      |
| `'4'` | **Ditolak**   | Admin Tata Persuratan menolak permohonan                       |

---

## 📋 ALUR DETAIL PER JENIS SURAT

### 1. Izin Observasi & Wawancara (SIOWI / SIOWK)

**Digunakan untuk:** Mata kuliah yang memerlukan izin observasi ke lembaga/instansi

| Langkah                     | Aktor     | File PHP                       | Keterangan                    |
| --------------------------- | --------- | ------------------------------ | ----------------------------- |
| Mahasiswa isi form individu | Mahasiswa | `formSiowiUser.php`            | Nama lembaga, tujuan, tanggal |
| Mahasiswa submit            | Mahasiswa | `sformSiowiUser.php`           | Insert ke `siow_individu`     |
| Admin Tata Persuratan lihat semua pengajuan | Admin Tata Persuratan     | `dataIowiAdm.php`              | Rekap semua status            |
| Admin Tata Persuratan proses surat          | Admin Tata Persuratan     | `editSiowiAdm.php`             | Update statusform → '2'       |
| Admin Tata Persuratan update status selesai | Admin Tata Persuratan     | `updateStatusformSiowiAdm.php` | Update statusform → '3'       |
| Mahasiswa cetak surat       | Mahasiswa | `cetakSiowiUser.php`           | Cetak PDF surat resmi         |
| Mahasiswa lihat riwayat     | Mahasiswa | `riwayatSiowiUser.php`         | Cek status pengajuan          |

> Untuk **kelompok**: ganti `Siowi` → `Siowk`, tabel: `siow_kelompok`

---

### 2. Izin Praktikum Testee Individu / Kelompok

**Digunakan untuk:** Mata kuliah praktikum psikologi (testee mahasiswa atau siswa)

**Varian:**

- `Siprakim` → Individu, Testee Mahasiswa (`siprak_mahasiswa`, `jenis_praktikum=1`)
- `Siprakis` → Individu, Testee Siswa (`siprak_siswa`, `jenis_praktikum=1`)
- `Siprakkmm` → Kelompok, Testee Mahasiswa (`siprak_mahasiswa`, `jenis_praktikum=2`)
- `Siprakks` → Kelompok, Testee Siswa (`siprak_siswa`, `jenis_praktikum=2`)

| Langkah             | Aktor     | File PHP                                   | Keterangan                  |
| ------------------- | --------- | ------------------------------------------ | --------------------------- |
| Mahasiswa isi form  | Mahasiswa | `formSiprakim/is/km/ksUser.php`            | Data testee, jadwal, tujuan |
| Submit              | Mahasiswa | `sformSiprakim/is/km/ksUser.php`           | Insert ke tabel             |
| Admin Tata Persuratan kelola        | Admin Tata Persuratan     | `dataIpitm/its/pktm/pktsAdm.php`           | Lihat & proses              |
| Admin Tata Persuratan update status | Admin Tata Persuratan     | `updateStatusformSiprakim/is/km/ksAdm.php` | Ubah statusform             |
| Mahasiswa cetak     | Mahasiswa | `cetakSiprakim/is/km/ksUser.php`           | Surat izin praktikum        |
| Riwayat             | Mahasiswa | `riwayatSiprakim/is/km/ksUser.php`         | Cek status                  |

---

### 3. Izin Magang Mandiri (SIMAGI / SIMAGK)

**Digunakan untuk:** Mahasiswa yang ingin magang di luar program resmi PKL

| Langkah                      | Aktor     | File PHP                                                  | Keterangan                     |
| ---------------------------- | --------- | --------------------------------------------------------- | ------------------------------ |
| Mahasiswa isi form individu  | Mahasiswa | `formSimagiUser.php`                                      | Data instansi, periode, tujuan |
| Mahasiswa submit             | Mahasiswa | `sformSimagiUser.php`                                     | Insert ke `magang` (`jenis=1`) |
| Admin Tata Persuratan lihat pengajuan magang | Admin Tata Persuratan     | `dataImiAdm.php` (individu) / `dataImkAdm.php` (kelompok) | Rekap status                   |
| Admin Tata Persuratan proses                 | Admin Tata Persuratan     | `editSimagIndividuAdm.php`                                | Update header + catatan        |
| Admin Tata Persuratan update status          | Admin Tata Persuratan     | `updateStatusformSimagIndividuAdm.php`                    | statusform → '3'               |
| Mahasiswa cetak surat        | Mahasiswa | `cetakSimagiUser.php`                                     | Cetak surat magang             |
| Riwayat                      | Mahasiswa | `riwayatSimagiUser.php`                                   | —                              |

> Untuk **kelompok**: ganti `Simagi` → `Simagk`, ada tambahan field anggota kelompok (`anggota_siowk`)

---

### 4. Izin Tempat PKL (SITP)

**Digunakan untuk:** Mendapatkan surat izin ke tempat PKL sebelum pelaksanaan

| Langkah            | Aktor     | File PHP                                          | Keterangan                         |
| ------------------ | --------- | ------------------------------------------------- | ---------------------------------- |
| Mahasiswa isi form | Mahasiswa | `formSitpUser.php`                                | Nama instansi PKL, alamat, periode |
| Submit             | Mahasiswa | `sformSitpUser.php`                               | Insert ke `sitp`                   |
| Admin Tata Persuratan kelola       | Admin Tata Persuratan     | `dataItpAdm.php`                                  | Lihat semua pengajuan              |
| Admin Tata Persuratan update       | Admin Tata Persuratan     | `editSitpAdm.php` + `updateStatusformSitpAdm.php` | Proses → Selesai                   |
| Mahasiswa cetak    | Mahasiswa | `cetakSitpUser.php`                               | Surat izin tempat PKL              |
| Riwayat            | Mahasiswa | `riwayatSitpUser.php`                             | —                                  |

**Tabel DB:** `sitp`

---

### 5. Izin Observasi Pra Skripsi (IOPS)

**Digunakan untuk:** Observasi awal sebelum penelitian skripsi formal

| Langkah             | Aktor     | File PHP                             | Keterangan                      |
| ------------------- | --------- | ------------------------------------ | ------------------------------- |
| Mahasiswa isi form  | Mahasiswa | `formPraSipsUser.php`                | Nama instansi, tujuan observasi |
| Submit              | Mahasiswa | `sformPraSipsUser.php`               | Insert ke `prasips`             |
| Admin Tata Persuratan kelola        | Admin Tata Persuratan     | `dataIopsAdm.php` (di `psychoApps/`) | Rekap & proses                  |
| Admin Tata Persuratan update status | Admin Tata Persuratan     | `updateStatusformPrasipsAdm.php`     | statusform → '3'                |
| Mahasiswa cetak     | Mahasiswa | `cetakPrasipsUser.php`               | Surat izin observasi            |
| Riwayat             | Mahasiswa | `riwayatPraSipsUser.php`             | —                               |

**Tabel DB:** `prasips`

---

### 6. Izin Penelitian Skripsi (SIPS)

**Digunakan untuk:** Surat izin resmi untuk penelitian skripsi ke instansi/lembaga

| Langkah            | Aktor     | File PHP                                          | Keterangan                                  |
| ------------------ | --------- | ------------------------------------------------- | ------------------------------------------- |
| Mahasiswa isi form | Mahasiswa | `formSipsUser.php`                                | Instansi, judul skripsi, periode penelitian |
| Submit             | Mahasiswa | `sformSipsUser.php`                               | Insert ke `sips`                            |
| Admin Tata Persuratan kelola       | Admin Tata Persuratan     | `dataIpsAdm.php`                                  | Rekap semua                                 |
| Admin Tata Persuratan update       | Admin Tata Persuratan     | `editSipsAdm.php` + `updateStatusformSipsAdm.php` | Proses → Selesai                            |
| Mahasiswa cetak    | Mahasiswa | `cetakSipsUser.php`                               | Surat penelitian resmi                      |
| Riwayat            | Mahasiswa | `riwayatSipsUser.php`                             | —                                           |

**Tabel DB:** `sips`

---

### 7. Keterangan Kelakuan Baik (SKKB)

**Digunakan untuk:** Surat keterangan kelakuan baik dari fakultas

| Langkah            | Aktor     | File PHP                                          | Keterangan             |
| ------------------ | --------- | ------------------------------------------------- | ---------------------- |
| Mahasiswa isi form | Mahasiswa | `formSkkbUser.php`                                | Keperluan surat        |
| Submit             | Mahasiswa | `sformSkkbUser.php`                               | Insert ke `skkb`       |
| Admin Tata Persuratan kelola       | Admin Tata Persuratan     | `dataKkbAdm.php`                                  | Rekap semua            |
| Admin Tata Persuratan update       | Admin Tata Persuratan     | `editSkkbAdm.php` + `updateStatusformSkkbAdm.php` | Proses → Selesai       |
| Mahasiswa cetak    | Mahasiswa | `cetakSkkbUser.php`                               | Surat keterangan resmi |
| Riwayat            | Mahasiswa | `riwayatSkkbUser.php`                             | —                      |

**Tabel DB:** `skkb`

---

## 🗃️ RINGKASAN TABEL DATABASE & FILE ADMIN

| Jenis Surat | Tabel DB                     | Data Admin Tata Persuratan         | Form User              | Cetak User              |
| ----------- | ---------------------------- | ------------------ | ---------------------- | ----------------------- |
| SIOWI       | `siow_individu`              | `dataIowiAdm.php`  | `formSiowiUser.php`    | `cetakSiowiUser.php`    |
| SIOWK       | `siow_kelompok`              | `dataIowkAdm.php`  | `formSiowkUser.php`    | `cetakSiowkUser.php`    |
| SIPRAKIM    | `siprak_mahasiswa` (jenis=1) | `dataIpitmAdm.php` | `formSiprakimUser.php` | `cetakSiprakimUser.php` |
| SIPRAKIS    | `siprak_siswa` (jenis=1)     | `dataIpitsAdm.php` | `formSiprakisUser.php` | `cetakSiprakisUser.php` |
| SIPRAKKTM   | `siprak_mahasiswa` (jenis=2) | `dataIpktmAdm.php` | `formSiprakkmUser.php` | `cetakSiprakkmUser.php` |
| SIPRAKKT    | `siprak_siswa` (jenis=2)     | `dataIpktsAdm.php` | `formSiprakksUser.php` | `cetakSiprakksUser.php` |
| SIMAGI      | `magang` (jenis=1)           | `dataImiAdm.php`   | `formSimagiUser.php`   | `cetakSimagiUser.php`   |
| SIMAGK      | `magang` (jenis=2)           | `dataImkAdm.php`   | `formSimagkUser.php`   | `cetakSimagkUser.php`   |
| SITP        | `sitp`                       | `dataItpAdm.php`   | `formSitpUser.php`     | `cetakSitpUser.php`     |
| IOPS        | `prasips`                    | `dataIopsAdm.php`  | `formPraSipsUser.php`  | `cetakPrasipsUser.php`  |
| SIPS        | `sips`                       | `dataIpsAdm.php`   | `formSipsUser.php`     | `cetakSipsUser.php`     |
| SKKB        | `skkb`                       | `dataKkbAdm.php`   | `formSkkbUser.php`     | `cetakSkkbUser.php`     |

---

## 🖥️ TAMPILAN DASHBOARD ADMIN

Admin Tata Persuratan dapat memantau seluruh surat dari satu halaman rekap:

**File:** `dataSuratMahasiswaAdm.php`

Menampilkan per jenis surat:

| Pengajuan        | Proses           | Selesai          | Ditolak          |
| ---------------- | ---------------- | ---------------- | ---------------- |
| `statusform='1'` | `statusform='2'` | `statusform='3'` | `statusform='4'` |

---

## ⚡ FITUR EKSPOR & CETAK ADMIN

Selain mengelola permohonan, admin juga dapat:

| Fitur                   | File PHP                            |
| ----------------------- | ----------------------------------- |
| Cetak rekap per periode | `cetakDataIowiPertahunAdm.php`, dll |
| Ekspor ke Excel         | `eksporIowiPertahunAdm.php`, dll    |
| Lihat rekap per tahun   | `dataIowiPertahunAdm.php`, dll      |
| Update catatan          | `updateCatatanSiowiAdm.php`, dll    |

---

## 🔑 FLAG PENTING DI DATABASE

| Field             | Nilai | Arti                                   |
| ----------------- | ----- | -------------------------------------- |
| `statusform`      | `'1'` | **Pengajuan** — menunggu diproses      |
| `statusform`      | `'2'` | **Proses** — sedang diproses admin     |
| `statusform`      | `'3'` | **Selesai** — surat siap diambil/cetak |
| `statusform`      | `'4'` | **Ditolak** — permohonan ditolak       |
| `jenis_magang`    | `'1'` | Magang **individu**                    |
| `jenis_magang`    | `'2'` | Magang **kelompok**                    |
| `jenis_praktikum` | `'1'` | Praktikum **individu**                 |
| `jenis_praktikum` | `'2'` | Praktikum **kelompok**                 |

---

_Dokumen ini dibuat berdasarkan analisis source code proyek psycoapp._  
_Dibuat: 2026-03-05_
