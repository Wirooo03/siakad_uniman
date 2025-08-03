# PANDUAN AKSES DATABASE POSTGRESQL DENGAN NAVICAT

## 📍 **LOKASI FILE DATABASE POSTGRESQL**

### Lokasi Data Directory:
```
C:/Program Files/PostgreSQL/17/data
```

### Lokasi Database siakad_uniman:
```
C:/Program Files/PostgreSQL/17/data/base/16386/
```

> **CATATAN PENTING**: PostgreSQL tidak menggunakan file database tunggal seperti SQLite. Data disimpan dalam multiple files di directory tersebut dengan struktur binary yang kompleks.

---

## 🔧 **KONFIGURASI NAVICAT**

### Connection Settings:
| Parameter | Value |
|-----------|-------|
| **Connection Type** | PostgreSQL |
| **Host** | `127.0.0.1` atau `localhost` |
| **Port** | `5432` |
| **Database** | `siakad_uniman` |
| **Username** | `postgres` |
| **Password** | `$H1+$h1+` |
| **Schema** | `public` |

### Langkah-langkah Setup Navicat:

1. **Buka Navicat** → New Connection → PostgreSQL
2. **General Tab:**
   - Connection Name: `SIAKAD PostgreSQL`
   - Host: `127.0.0.1`
   - Port: `5432`
   - User Name: `postgres`
   - Password: `$H1+$h1+`
   - Database: `siakad_uniman`

3. **Test Connection** untuk memastikan koneksi berhasil
4. **Save & Connect**

---

## 📊 **STRUKTUR DATABASE SAAT INI**

### Tabel dengan Data:
- ✅ **mahasiswa** (5 records) - Data utama mahasiswa
- ✅ **users** (1 record) - Data user system
- ✅ **migrations** (4 records) - Laravel migration history

### Tabel Kosong (Laravel Default):
- ⭕ cache, cache_locks, failed_jobs, job_batches, jobs
- ⭕ password_reset_tokens, sessions

---

## 🏗️ **STRUKTUR TABEL MAHASISWA**

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | bigint | PRIMARY KEY, AUTO INCREMENT | ID unik mahasiswa |
| `nim` | varchar(255) | NOT NULL, UNIQUE | Nomor Induk Mahasiswa |
| `nama` | varchar(255) | NOT NULL | Nama lengkap |
| `email` | varchar(255) | NOT NULL, UNIQUE | Email mahasiswa |
| `jurusan` | varchar(255) | NOT NULL | Program studi |
| `semester` | integer | NOT NULL | Semester aktif |
| `status` | varchar(255) | NOT NULL, DEFAULT 'aktif' | Status mahasiswa |
| `tanggal_masuk` | date | NOT NULL | Tanggal masuk |
| `alamat` | varchar(255) | NULL | Alamat rumah |
| `telepon` | varchar(255) | NULL | Nomor telepon |
| `created_at` | timestamp | NULL | Waktu dibuat |
| `updated_at` | timestamp | NULL | Waktu diupdate |

---

## 🔗 **RELASI DATABASE**

> **STATUS**: Saat ini tidak ada foreign key constraints
> 
> **ALASAN**: Database masih dalam tahap development awal

### Relasi yang Mungkin Ditambahkan Nanti:
- `mahasiswa.jurusan_id` → `jurusan.id`
- `mahasiswa.dosen_wali_id` → `dosen.id`
- `nilai.mahasiswa_id` → `mahasiswa.id`
- `nilai.mata_kuliah_id` → `mata_kuliah.id`

---

## 📄 **SAMPLE DATA MAHASISWA**

```sql
-- Data yang ada saat ini:
SELECT nim, nama, jurusan, semester, status FROM mahasiswa;

/*
nim          | nama           | jurusan              | semester | status
-------------|----------------|----------------------|----------|--------
123456789    | John Doe       | Teknik Informatika   | 3        | aktif
987654321    | Jane Smith     | Sistem Informasi     | 5        | aktif
111222333    | Ahmad Rahman   | Teknik Informatika   | 1        | aktif
444555666    | Siti Nurhaliza | Sistem Informasi     | 7        | aktif
777888999    | Budi Santoso   | Teknik Informatika   | 2        | cuti
*/
```

---

## 🛠️ **TIPS MENGGUNAKAN NAVICAT**

### 1. **Melihat Data:**
- Klik kanan pada tabel → "Open Table"
- Double-click pada tabel untuk edit data

### 2. **Menjalankan Query:**
- Tools → Query Editor
- Atau tekan `Ctrl + Q`

### 3. **Export Data:**
- Klik kanan tabel → "Export Wizard"
- Pilih format: SQL, Excel, CSV, dll

### 4. **Import Data:**
- Klik kanan tabel → "Import Wizard"
- Support multiple format

### 5. **Backup Database:**
- Tools → Backup → PostgreSQL Backup
- Atau gunakan pg_dump via command line

---

## ⚠️ **TROUBLESHOOTING UMUM**

### Connection Failed:
1. **Cek PostgreSQL Service:**
   ```cmd
   services.msc → PostgreSQL 17
   ```

2. **Cek Port 5432:**
   ```cmd
   netstat -an | findstr 5432
   ```

3. **Test dengan psql:**
   ```cmd
   psql -U postgres -d siakad_uniman -h 127.0.0.1
   ```

### Authentication Failed:
- Pastikan password: `$H1+$h1+`
- Cek pg_hba.conf untuk authentication method

---

## 📱 **AKSES VIA APLIKASI LAIN**

### **pgAdmin 4** (Alternatif Navicat):
- URL: `http://localhost/pgAdmin4` (jika terinstall)
- Server: 127.0.0.1:5432
- Database: siakad_uniman

### **Command Line**:
```bash
# Akses database
psql -U postgres -d siakad_uniman

# Export data
pg_dump -U postgres -d siakad_uniman > backup.sql

# Import data  
psql -U postgres -d siakad_uniman < backup.sql
```

### **DBeaver** (Free Alternative):
- Download: https://dbeaver.io/
- Same connection settings as Navicat

---

## ✅ **VERIFIKASI KONEKSI**

Untuk memastikan semua berjalan, jalankan:

```bash
cd d:\main\v1\experiment\bejir\backend
php database_info.php
```

Atau test melalui browser:
```
http://localhost:8000/api/health
```
