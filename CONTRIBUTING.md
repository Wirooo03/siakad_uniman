# 🤝 Contributing to SIAKAD

Terima kasih atas minat Anda untuk berkontribusi pada proyek SIAKAD!

## 📋 Panduan Kontribusi

### 1. Fork Repository
- Fork repository ini ke akun GitHub Anda
- Clone fork tersebut ke komputer lokal

### 2. Setup Development Environment
```bash
# Clone repository
git clone https://github.com/your-username/siakad_uniman.git
cd siakad_uniman

# Setup proyek (ikuti README.md)
./setup.sh  # Linux/Mac
# atau
setup.bat   # Windows
```

### 3. Buat Branch Baru
```bash
# Buat branch untuk fitur baru
git checkout -b feature/nama-fitur

# Atau untuk bug fix
git checkout -b fix/nama-bug
```

### 4. Development Guidelines

#### Code Style:
- **Backend (PHP/Laravel)**: Ikuti PSR-12 coding standard
- **Frontend (TypeScript/React)**: Gunakan Prettier dan ESLint
- **Database**: Gunakan nama tabel dan kolom dalam bahasa Inggris
- **Commit Message**: Gunakan format conventional commits

#### Contoh Commit Message:
```
feat: add student search functionality
fix: resolve pagination bug in student list
docs: update API documentation
refactor: improve database query performance
```

### 5. Testing
```bash
# Backend testing
cd backend
php artisan test

# Frontend testing (jika ada)
cd frontend
npm run test
```

### 6. Submit Pull Request

1. Push branch ke repository fork Anda:
   ```bash
   git push origin feature/nama-fitur
   ```

2. Buat Pull Request di GitHub dengan:
   - Judul yang jelas dan deskriptif
   - Deskripsi detail tentang perubahan
   - Screenshot (jika ada perubahan UI)
   - Link ke issue terkait (jika ada)

## 🎯 Area Kontribusi

### Frontend (Next.js/React):
- Perbaikan UI/UX
- Fitur baru untuk mahasiswa
- Optimisasi performa
- Responsive design

### Backend (Laravel):
- API endpoints baru
- Optimisasi database
- Security improvements
- Feature enhancements

### Documentation:
- Perbaikan README
- API documentation
- User guides
- Code comments

### Testing:
- Unit tests
- Integration tests
- Feature tests
- Bug fixes

## 🐛 Melaporkan Bug

1. Cek apakah bug sudah dilaporkan di Issues
2. Buat issue baru dengan:
   - Judul yang jelas
   - Langkah reproduksi
   - Expected behavior
   - Actual behavior
   - Screenshot/log error
   - Environment details

## 💡 Menyarankan Fitur

1. Cek apakah fitur sudah diusulkan di Issues
2. Buat issue baru dengan label "enhancement"
3. Jelaskan:
   - Kebutuhan/masalah yang ingin diselesaikan
   - Solusi yang diusulkan
   - Alternatif yang sudah dipertimbangkan
   - Manfaat untuk pengguna

## 📝 Code Review Process

1. Semua PR akan di-review oleh maintainer
2. Pastikan semua tests pass
3. Responds terhadap feedback reviewer
4. PR akan di-merge setelah approved

## 🏷️ Branch Naming Convention

- `feature/nama-fitur` - Fitur baru
- `fix/nama-bug` - Bug fix
- `hotfix/critical-fix` - Critical bug fix
- `docs/update-readme` - Documentation updates
- `refactor/improve-code` - Code refactoring

## 📋 Checklist sebelum Submit PR

- [ ] Code sudah di-test dan berfungsi dengan baik
- [ ] Tidak ada error di console browser (frontend)
- [ ] Tidak ada error di log Laravel (backend)
- [ ] Code style sudah sesuai guidelines
- [ ] Documentation sudah diupdate (jika perlu)
- [ ] PR description sudah lengkap

## 🚀 Development Tools

### Recommended VSCode Extensions:
- PHP Intelephense
- Laravel Extension Pack
- ES7+ React/Redux/React-Native snippets
- Prettier - Code formatter
- ESLint
- Thunder Client (untuk testing API)

### Useful Commands:
```bash
# Laravel commands
php artisan make:controller ControllerName
php artisan make:model ModelName -m
php artisan migrate:fresh --seed

# Next.js commands
npm run dev
npm run build
npm run lint
```

## 🙋‍♂️ Butuh Bantuan?

- Buat issue dengan label "question"
- Join Discord server (jika ada)
- Email ke maintainer

## 📄 License

Dengan berkontribusi, Anda setuju bahwa kontribusi Anda akan dilisensikan di bawah MIT License yang sama dengan proyek ini.

---

**Terima kasih atas kontribusi Anda!** 🎉
