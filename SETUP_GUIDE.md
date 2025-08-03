# Setup Backend Laravel + Frontend Next.js

## Struktur Project
```
bejir/
├── test_github_copilot/     # Frontend Next.js
│   ├── src/
│   │   ├── app/
│   │   │   ├── api-test/    # Halaman test API
│   │   │   └── ...
│   │   └── lib/
│   │       └── api.js       # API service helper
│   └── ...
└── backend/                 # Backend Laravel
    ├── routes/
    │   └── api.php          # API routes
    ├── config/
    │   └── cors.php         # CORS configuration
    ├── start-server.bat     # Script untuk start server
    └── ...
```

## Cara Menjalankan

### 1. Backend Laravel

#### Setup Database
```bash
cd backend
php artisan migrate
```

#### Menjalankan Server
**Opsi 1: Via Command Line**
```bash
cd backend
php artisan serve
```

**Opsi 2: Via Batch File (Windows)**
- Double-click file `start-server.bat` di folder backend

Server Laravel akan berjalan di: **http://127.0.0.1:8000**

### 2. Frontend Next.js
```bash
cd test_github_copilot
npm run dev
```

Frontend akan berjalan di: **http://localhost:3000**

## API Endpoints

### Base URL
```
http://127.0.0.1:8000/api
```

### Available Endpoints

#### 1. Test Connection
- **Method:** GET
- **URL:** `/api/test`
- **Response:**
```json
{
    "message": "API is working!",
    "timestamp": "2025-08-01T10:00:00.000000Z",
    "status": "success"
}
```

#### 2. Get All Mahasiswa
- **Method:** GET
- **URL:** `/api/mahasiswa`
- **Response:**
```json
{
    "data": [
        {
            "id": 1,
            "nama": "John Doe",
            "nim": "123456789",
            "jurusan": "Teknik Informatika",
            "semester": 6
        },
        {
            "id": 2,
            "nama": "Jane Smith",
            "nim": "987654321",
            "jurusan": "Sistem Informasi",
            "semester": 4
        }
    ],
    "message": "Data mahasiswa berhasil diambil",
    "status": "success"
}
```

#### 3. Get Mahasiswa by ID
- **Method:** GET
- **URL:** `/api/mahasiswa/{id}`
- **Response:**
```json
{
    "data": {
        "id": 1,
        "nama": "John Doe",
        "nim": "123456789",
        "jurusan": "Teknik Informatika",
        "semester": 6,
        "email": "john.doe@example.com"
    },
    "message": "Detail mahasiswa berhasil diambil",
    "status": "success"
}
```

## Testing API

### 1. Via Frontend Test Page
1. Pastikan backend Laravel sudah berjalan
2. Buka frontend Next.js
3. Navigasi ke halaman **"API Test"** di menu
4. Klik tombol "Test Connection" untuk test koneksi
5. Klik tombol "Get Mahasiswa Data" untuk test data

### 2. Via Browser
- Test connection: http://127.0.0.1:8000/api/test
- Test mahasiswa: http://127.0.0.1:8000/api/mahasiswa

### 3. Via Postman/Insomnia
- Import collection dengan base URL: `http://127.0.0.1:8000/api`
- Headers: `Accept: application/json`

## CORS Configuration

Backend sudah dikonfigurasi untuk menerima request dari:
- `http://localhost:3000` (Next.js default)
- `http://127.0.0.1:3000`

Jika frontend berjalan di port lain, update file `backend/config/cors.php`.

## Troubleshooting

### Backend Issues
1. **"php command not found"**
   - Install PHP dan pastikan ada di PATH

2. **"composer command not found"**
   - Install Composer: https://getcomposer.org/

3. **Server tidak bisa diakses**
   - Pastikan port 8000 tidak digunakan aplikasi lain
   - Coba port lain: `php artisan serve --port=8001`

### Frontend Issues
1. **CORS Error**
   - Pastikan backend sudah berjalan
   - Cek konfigurasi CORS di `backend/config/cors.php`

2. **API Connection Failed**
   - Pastikan URL API benar: `http://127.0.0.1:8000/api`
   - Cek network tab di browser developer tools

### Development Tips
1. Jalankan backend terlebih dahulu sebelum frontend
2. Gunakan browser developer tools untuk debug API calls
3. Check console log untuk error messages
4. Gunakan Postman untuk test API secara terpisah

## Next Steps
1. Implementasi authentication/login
2. Tambah CRUD operations untuk mahasiswa
3. Implementasi database migration untuk data real
4. Tambah validation dan error handling
5. Setup production environment
