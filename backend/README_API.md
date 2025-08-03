# Laravel Backend API

## Setup dan Instalasi

### Prerequisites
- PHP >= 8.2
- Composer
- SQLite (sudah termasuk dalam PHP)

### Menjalankan Server
```bash
cd backend
php artisan serve
```

Server akan berjalan di: http://127.0.0.1:8000

### API Endpoints

#### Test API
- **GET** `/api/test` - Test koneksi API

#### Mahasiswa
- **GET** `/api/mahasiswa` - Daftar semua mahasiswa
- **GET** `/api/mahasiswa/{id}` - Detail mahasiswa berdasarkan ID

### Contoh Response

#### GET /api/test
```json
{
    "message": "API is working!",
    "timestamp": "2025-08-01T10:00:00.000000Z",
    "status": "success"
}
```

#### GET /api/mahasiswa
```json
{
    "data": [
        {
            "id": 1,
            "nama": "John Doe",
            "nim": "123456789",
            "jurusan": "Teknik Informatika",
            "semester": 6
        }
    ],
    "message": "Data mahasiswa berhasil diambil",
    "status": "success"
}
```

### CORS Configuration
API sudah dikonfigurasi untuk menerima request dari:
- http://localhost:3000 (Next.js default)
- http://127.0.0.1:3000

### Environment
Pastikan file `.env` sudah dikonfigurasi dengan benar:
```
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite
```
