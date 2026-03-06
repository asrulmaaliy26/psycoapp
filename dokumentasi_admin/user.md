# 🔐 Dokumentasi User & Autentikasi — Sistem Psikologi Apps

Dokumen ini menjelaskan **di mana** username & password disimpan, metode enkripsi, dan cara login masing-masing role.

---

## 🗝️ SATU TABEL PUSAT: `dt_all_adm`

**Hampir semua user** (kecuali Mahasiswa S2) login melalui satu tabel:

```sql
TABLE: dt_all_adm
```

| Kolom            | Tipe    | Keterangan                             |
| ---------------- | ------- | -------------------------------------- |
| `username`       | VARCHAR | Username atau NIM atau NIP             |
| `password`       | VARCHAR | **MD5** dari password asli             |
| `level`          | INT     | Kode role (lihat tabel level di bawah) |
| `nm_person`      | VARCHAR | Nama lengkap untuk ditampilkan         |
| `login_terakhir` | VARCHAR | Timestamp login terakhir               |
| `status`         | CHAR(1) | `'1'` = aktif, `'0'` = nonaktif        |

### Kode Level di `dt_all_adm`

| Level | Role                          | Dashboard Tujuan                 |
| ----- | ----------------------------- | -------------------------------- |
| `1`   | **Dosen**                     | `dashboardBeritaAcaraSempro.php` |
| `2`   | **Mahasiswa S1**              | `dashboardUserS1.php`            |
| `4`   | **Admin Kepegawaian**         | `dashboardAdmKepeg.php`          |
| `5`   | **Admin BMN**                 | `dashboardAdmBmn.php`            |
| `6`   | **Admin Tata Persuratan**     | `agendaSuratKeluarAdm.php`       |
| `7`   | **Admin BAK S1**              | `dashboardAdmBakS1.php`          |
| `8`   | **Admin BAK S2** (psychoApps) | `dashboardAdmBakS2.php`          |

> **Login URL:** `psychoApps/index.php` → proses: `logAllAdm.php`

---

## 📋 TABEL PER ROLE (Detail)

### 1. 🧑‍🎓 Mahasiswa S1

| Item              | Detail                                    |
| ----------------- | ----------------------------------------- |
| **Tabel login**   | `dt_all_adm` (level = `2`)                |
| **Username**      | NIM mahasiswa                             |
| **Password**      | MD5                                       |
| **Tabel data**    | `dt_mhssw` (biodata, IPK, semester, dll)  |
| **Import massal** | `sformImporUserMahasiswaS1.php`           |
| **File login**    | `logAllAdm.php`                           |
| **Session keys**  | `username`, `password`, `level`, `status` |

---

### 2. 🧑‍🎓 Mahasiswa S2 (Simagis)

| Item              | Detail                                    |
| ----------------- | ----------------------------------------- |
| **Tabel login**   | `mag_dt_mhssw_pasca` ← **tabel berbeda!** |
| **Username**      | NIM mahasiswa (kolom `nim`)               |
| **Password**      | MD5 (kolom `password`)                    |
| **Kolom status**  | `status` = `'1'` untuk aktif              |
| **Import massal** | `sformImportDataMhssw.php` (simagis)      |
| **File login**    | `simagis/logUser.php`                     |
| **Session keys**  | `nim`, `password`, `status`               |

```sql
-- Struktur kunci tabel login S2:
TABLE: mag_dt_mhssw_pasca
  nim          VARCHAR  -- username login
  password     VARCHAR  -- MD5
  nama         VARCHAR
  angkatan     VARCHAR
  status       CHAR(1)  -- '1' aktif
  jenis_kelamin CHAR(1)
```

---

### 3. 👨‍🏫 Dosen

| Item                  | Detail                                                   |
| --------------------- | -------------------------------------------------------- |
| **Tabel login**       | `dt_all_adm` (level = `1`)                               |
| **Username**          | NIP dosen                                                |
| **Password**          | MD5                                                      |
| **Tabel data detail** | `dt_pegawai` (juga menyimpan kolom `password`)           |
| **Dibuat via**        | `sDtDosen.php` (insert ke `dt_pegawai` DAN `dt_all_adm`) |
| **File login**        | `logAllAdm.php`                                          |

> ⚠️ Dosen disimpan di **dua tempat**: `dt_pegawai.password` (MD5) dan `dt_all_adm.password` (MD5). Keduanya harus sinkron.

---

### 4. 👤 Admin Kepegawaian & Tendik

| Item            | Detail                     |
| --------------- | -------------------------- |
| **Tabel login** | `dt_all_adm` (level = `4`) |
| **Username**    | ID/NIP pegawai             |
| **Password**    | MD5                        |
| **Tabel data**  | `dt_pegawai`               |
| **Dibuat via**  | `sDtTendik.php`            |
| **File login**  | `logAllAdm.php`            |

---

### 5. 🏢 Admin BMN

| Item            | Detail                     |
| --------------- | -------------------------- |
| **Tabel login** | `dt_all_adm` (level = `5`) |
| **File login**  | `logAllAdm.php`            |

---

### 6. 📄 Admin Tata Persuratan

| Item              | Detail                             |
| ----------------- | ---------------------------------- |
| **Tabel login**   | `dt_all_adm` (level = `6`)         |
| **Import massal** | `sformImporUserTataPersuratan.php` |
| **File login**    | `logAllAdm.php`                    |

---

### 7. 🏛️ Admin BAK S1

| Item            | Detail                     |
| --------------- | -------------------------- |
| **Tabel login** | `dt_all_adm` (level = `7`) |
| **File login**  | `logAllAdm.php`            |

---

### 8. 🎓 Admin BAK S2 (Simagis)

| Item             | Detail                                  |
| ---------------- | --------------------------------------- |
| **Tabel login**  | `mag_dt_admin_bak` ← **tabel berbeda!** |
| **Username**     | Username admin                          |
| **Password**     | MD5                                     |
| **File login**   | `simagis/logAdm.php`                    |
| **Session keys** | `username`, `password`, `status`        |

---

### 9. ⚡ Super Admin (baru)

| Item             | Detail                                             |
| ---------------- | -------------------------------------------------- |
| **Tabel login**  | **Tidak ada** — credentials di `configSA.php`      |
| **Username**     | `superadmin` (hardcoded di config)                 |
| **Password**     | **bcrypt** (`password_hash`) ← lebih aman dari MD5 |
| **File config**  | `psychoApps/configSA.php`                          |
| **File login**   | `psychoApps/superAdminLogin.php`                   |
| **Session keys** | `is_superadmin`, `sa_role_active`, `sa_role_label` |

---

## 🔑 RINGKASAN: Di Mana Cari User?

| Role           | Tabel                | Kolom Username     | Kolom Password | Enkripsi   |
| -------------- | -------------------- | ------------------ | -------------- | ---------- |
| Semua Admin S1 | `dt_all_adm`         | `username`         | `password`     | MD5        |
| Mahasiswa S1   | `dt_all_adm`         | `username` (= NIM) | `password`     | MD5        |
| Dosen          | `dt_all_adm`         | `username` (= NIP) | `password`     | MD5        |
| Mahasiswa S2   | `mag_dt_mhssw_pasca` | `nim`              | `password`     | MD5        |
| Admin BAK S2   | `mag_dt_admin_bak`   | `username`         | `password`     | MD5        |
| Super Admin    | `configSA.php`       | `SA_USERNAME`      | `SA_PASS_HASH` | **bcrypt** |

---

## 🧪 Query Berguna

### Lihat semua user & role

```sql
SELECT username, nm_person, level, status FROM dt_all_adm ORDER BY level, username;
```

### Ganti password user (MD5)

```sql
UPDATE dt_all_adm SET password = MD5('password_baru') WHERE username = 'usernamenya';
```

### Tambah user baru

```sql
INSERT INTO dt_all_adm (username, password, level, nm_person, login_terakhir, status)
VALUES ('username_baru', MD5('password123'), '7', 'Nama Lengkap', '', '1');
-- level 7 = Admin BAK S1, ganti sesuai kebutuhan
```

### Reset password Mahasiswa S2

```sql
UPDATE mag_dt_mhssw_pasca SET password = MD5('password_baru') WHERE nim = 'nim_mahasiswa';
```

### Reset password Admin BAK S2

```sql
UPDATE mag_dt_admin_bak SET password = MD5('password_baru') WHERE username = 'username_admin';
```

---

## ⚠️ Catatan Keamanan

> [!WARNING]
> Semua password sistem menggunakan **MD5** yang sudah dianggap tidak aman. MD5 rentan terhadap rainbow table attack. Untuk sistem produksi, disarankan migrasi ke `bcrypt` atau `Argon2`.

> [!NOTE]
> Super Admin menggunakan **bcrypt** (lebih aman). Untuk mengubah password SA, jalankan:
>
> ```bash
> php -r "echo password_hash('password_baru', PASSWORD_DEFAULT);"
> ```
>
> Lalu tempelkan hasilnya ke konstanta `SA_PASS_HASH` di `configSA.php`.

---

## 📂 File Login Per Role

| File                                             | Role yang Login                                                        |
| ------------------------------------------------ | ---------------------------------------------------------------------- |
| `psychoApps/logAllAdm.php`                       | Admin BAK S1, Admin Kepeg, Admin BMN, Admin Taper, Dosen, Mahasiswa S1 |
| `simagis/logAdm.php`                             | Admin BAK S2 (Simagis)                                                 |
| `simagis/logUser.php`                            | Mahasiswa S2 (Simagis)                                                 |
| `psychoApps/superAdminLogin.php` → `sformSA.php` | Super Admin                                                            |

---

_Dokumen dibuat berdasarkan analisis source code — Maret 2026_
