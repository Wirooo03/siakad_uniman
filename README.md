# 🎓 SIAKAD - Sistem Informasi Akademik

Student Information System dengan teknologi modern: Next.js, Laravel, dan PostgreSQL.

## 📁 Struktur Project

```
bejir/
├── 📂 backend/                 # Laravel API Backend
│   ├── app/Models/             # Database Models
│   ├── database/migrations/    # Database Migrations  
│   ├── routes/api.php         # API Routes
│   └── ...
├── 📂 test_github_copilot/    # Next.js Frontend
│   ├── src/
│   │   ├── app/               # Next.js App Router
│   │   ├── components/        # React Components
│   │   │   └── ui/            # Reusable UI Components
│   │   ├── config/            # Configuration Files
│   │   ├── lib/               # Utilities & API Service
│   │   └── styles/            # CSS & Styling
│   └── ...
├── 📂 docs/                   # Dokumentasi Project
└── cleanup.ps1               # Script untuk cleanup project
```

## 🚀 Quick Start

### 1. Backend Setup (Laravel)
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --host=0.0.0.0 --port=8000
```

### 2. Frontend Setup (Next.js)
```bash
cd test_github_copilot
npm install
cp .env.example .env.local
npm run dev
```

### 3. Environment Configuration
Edit `.env.local` untuk mengubah backend URL:
```env
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api
```

## 🎯 Fitur Utama

- ✅ **CRUD Mahasiswa** - Create, Read, Update, Delete data mahasiswa
- ✅ **Search & Filter** - Pencarian dan filter data
- ✅ **Pagination** - Pagination untuk data besar
- ✅ **Responsive Design** - UI responsif untuk semua device
- ✅ **API Terpusat** - Konfigurasi API yang mudah diubah
- ✅ **Validation** - Validasi data frontend dan backend
- ✅ **Error Handling** - Penanganan error yang komprehensif

## 🛠️ Teknologi

**Frontend:**
- Next.js 14 (App Router)
- React 18
- TypeScript
- Tailwind CSS
- Custom UI Components

**Backend:**
- Laravel 10
- PostgreSQL
- RESTful API
- Validation & Error Handling

## 📖 Dokumentasi

Lihat folder `docs/` untuk dokumentasi lengkap:
- [Setup Guide](docs/SETUP_GUIDE.md)
- [API Configuration](docs/CHANGE_API_URL.md) 
- [Database Schema](docs/DATABASE_EXTENDED_SUMMARY.md)
- [Troubleshooting](docs/TROUBLESHOOTING.md)

## 🔧 Development Tools

### UI Components
Project menggunakan UI components terpusat di `src/components/ui/`:
```jsx
import { Button, Input, Select } from '@/components/ui';

<Button variant="primary" onClick={handleSave}>
  Simpan
</Button>
```

### CSS Classes
CSS classes terpusat di `src/styles/components.css`:
```css
.btn-primary { /* ... */ }
.form-input { /* ... */ }
.card { /* ... */ }
```

### API Service
API service terpusat dengan konfigurasi mudah:
```javascript
import apiService from '@/lib/api';

const data = await apiService.getMahasiswa();
```

## 🧹 Project Maintenance

Jalankan script cleanup untuk membersihkan project:
```bash
powershell -ExecutionPolicy Bypass -File cleanup.ps1
```

## 🤝 Contributing

1. Fork project
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## 📄 License

MIT License - lihat file LICENSE untuk detail.

---

**Dibuat dengan ❤️ untuk sistem akademik yang modern dan efisien.**
