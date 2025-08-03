# Panduan Mengubah API Base URL

## 📍 Lokasi File Konfigurasi

File utama yang perlu diubah: **`.env.local`**

```bash
d:\main\v1\experiment\bejir\test_github_copilot\.env.local
```

## 🔧 Cara Mengubah Backend URL

### 1. Edit File .env.local

Buka file `.env.local` dan ubah baris:

```env
# Dari localhost (device sekarang)
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api

# Ke device lain, contoh:
NEXT_PUBLIC_API_BASE_URL=http://192.168.1.100:8000/api
```

### 2. Contoh Konfigurasi Device Lain

```env
# Local network (ganti dengan IP device backend)
NEXT_PUBLIC_API_BASE_URL=http://192.168.1.100:8000/api

# Jika menggunakan domain
NEXT_PUBLIC_API_BASE_URL=https://your-server.com/api

# Jika port berbeda
NEXT_PUBLIC_API_BASE_URL=http://192.168.1.100:8080/api
```

### 3. Restart Development Server

Setelah mengubah `.env.local`, restart Next.js development server:

```bash
cd d:\main\v1\experiment\bejir\test_github_copilot
npm run dev
```

## 🔍 Verifikasi Perubahan

1. **Check Console Browser**: Buka Developer Tools → Console
2. **Lihat Log**: Akan muncul log seperti:
   ```
   === API Configuration ===
   Base URL: http://192.168.1.100:8000/api
   Timeout: 30000
   ========================
   ApiService initialized with base URL: http://192.168.1.100:8000/api
   ```

3. **Test API Call**: Buka halaman mahasiswa dan lihat di Network tab:
   ```
   GET request to: http://192.168.1.100:8000/api/mahasiswa
   ```

## 📁 File yang Terlibat

1. **`.env.local`** - Konfigurasi environment
2. **`src/config/api.ts`** - File konfigurasi API terpusat
3. **`src/lib/api.js`** - Service layer yang menggunakan config

## 🛠️ Setup Backend di Device Lain

Di device backend baru, pastikan:

1. **Install Dependencies**:
   ```bash
   cd backend_folder
   composer install
   ```

2. **Setup Database**:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

3. **Start Server**:
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

4. **Allow External Connections**: Pastikan firewall mengizinkan port 8000

## 🔐 Konfigurasi CORS (Jika Diperlukan)

Jika menggunakan device berbeda, mungkin perlu update CORS di Laravel:

**File**: `backend/config/cors.php`
```php
'allowed_origins' => [
    'http://localhost:3000',
    'http://192.168.1.50:3000', // IP device frontend
],
```

## 🚀 Quick Setup Commands

```bash
# 1. Update .env.local
echo "NEXT_PUBLIC_API_BASE_URL=http://192.168.1.100:8000/api" > .env.local

# 2. Restart frontend
npm run dev

# 3. Test connection
curl http://192.168.1.100:8000/api/test
```

## 📝 Troubleshooting

**Problem**: "Network Error" atau "CORS Error"
**Solution**: 
1. Cek IP address benar
2. Cek backend server running
3. Cek firewall/network access
4. Update CORS configuration

**Problem**: "404 Not Found"
**Solution**:
1. Pastikan endpoint `/api` benar
2. Cek Laravel routing
3. Verify server configuration

## ✅ Benefits

- ✅ **Single Point of Configuration**: Ubah sekali di `.env.local`
- ✅ **Environment Specific**: Beda config untuk dev/staging/prod
- ✅ **Easy Migration**: Pindah backend tinggal ubah 1 baris
- ✅ **Debugging**: Log semua request URL di console
- ✅ **Type Safe**: TypeScript config dengan intellisense
