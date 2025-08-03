# 🗄️ Database Setup - Laravel Backend

## ✅ Database Status: READY!

### 📊 Database Configuration
- **Type:** SQLite
- **File:** `database/database.sqlite`
- **Connection:** Configured in `.env`

### 🏗️ Database Structure

#### Table: `mahasiswa`
| Column | Type | Description |
|--------|------|-------------|
| `id` | Primary Key | Auto increment ID |
| `nim` | String (Unique) | Nomor Induk Mahasiswa |
| `nama` | String | Nama lengkap mahasiswa |
| `email` | String (Unique) | Email mahasiswa |
| `jurusan` | String | Program studi |
| `semester` | Integer | Semester saat ini |
| `status` | String | aktif/cuti/lulus/dropout |
| `tanggal_masuk` | Date | Tanggal masuk kuliah |
| `alamat` | String (Nullable) | Alamat lengkap |
| `telepon` | String (Nullable) | Nomor telepon |
| `created_at` | Timestamp | Waktu dibuat |
| `updated_at` | Timestamp | Waktu diupdate |

### 📋 Sample Data (5 records)
1. **John Doe** (123456789) - Teknik Informatika, Semester 6
2. **Jane Smith** (987654321) - Sistem Informasi, Semester 4  
3. **Ahmad Rahman** (111222333) - Teknik Informatika, Semester 8
4. **Siti Nurhaliza** (444555666) - Manajemen Informatika, Semester 2
5. **Budi Santoso** (777888999) - Sistem Informasi, Semester 6 (Status: Cuti)

## 🔗 API Endpoints (Updated dengan Database)

### Base URL: `http://127.0.0.1:8000/api`

#### 1. Test Connection
- **GET** `/test`
- Response includes database status

#### 2. All Mahasiswa
- **GET** `/mahasiswa`
- Returns all mahasiswa from database

#### 3. Mahasiswa by ID
- **GET** `/mahasiswa/{id}`
- Returns specific mahasiswa

#### 4. Mahasiswa by Jurusan
- **GET** `/mahasiswa/jurusan/{jurusan}`
- Filter by program studi

#### 5. Active Mahasiswa Only
- **GET** `/mahasiswa/status/aktif`
- Returns only active students

## 📱 Example API Responses

### GET /api/mahasiswa
```json
{
    "data": [
        {
            "id": 1,
            "nim": "123456789",
            "nama": "John Doe",
            "email": "john.doe@uniman.ac.id",
            "jurusan": "Teknik Informatika",
            "semester": 6,
            "status": "aktif",
            "tanggal_masuk": "2022-08-01",
            "alamat": "Jl. Sudirman No. 123, Manado",
            "telepon": "081234567890"
        }
    ],
    "total": 5,
    "message": "Data mahasiswa berhasil diambil",
    "status": "success"
}
```

### GET /api/mahasiswa/jurusan/Teknik%20Informatika
```json
{
    "data": [...],
    "total": 2,
    "jurusan": "Teknik Informatika",
    "message": "Data mahasiswa berdasarkan jurusan berhasil diambil",
    "status": "success"
}
```

## 🔧 Database Commands

### Reset & Reseed Database
```bash
php artisan migrate:fresh --seed
```

### Just Run Seeders
```bash
php artisan db:seed
```

### Add More Data
Edit `database/seeders/MahasiswaSeeder.php` and run:
```bash
php artisan db:seed --class=MahasiswaSeeder
```

## 🎯 Next Steps
1. ✅ Database siap digunakan
2. ✅ Sample data sudah ada
3. ✅ API endpoints updated
4. 🔄 Test API dari frontend
5. 🔄 Implementasi CRUD operations
6. 🔄 Add authentication

**Database SQLite dengan sample data mahasiswa sudah siap!** 🎉
