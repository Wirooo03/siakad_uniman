<?php
echo "=== MENAMBAH 25 MAHASISWA BARU (UNIK) ===\n\n";

try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '$H1+$h1+');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Koneksi PostgreSQL berhasil!\n\n";
    
    // Cek jumlah mahasiswa saat ini
    $stmt = $pdo->query("SELECT COUNT(*) FROM mahasiswa");
    $current_count = $stmt->fetchColumn();
    echo "📊 Jumlah mahasiswa saat ini: {$current_count}\n\n";
    
    // Data mahasiswa baru dengan NIM yang benar-benar unik (dimulai dari 2025XXXXX)
    $mahasiswa_baru = [
        ['202501001', 'Anita Sari', 'anita.sari@uniman.ac.id', 'Teknik Informatika', 1, 'aktif', '2025-08-01', 'Jl. Raya Timur No. 101', '081234567901'],
        ['202501002', 'Bagas Pratama', 'bagas.pratama@uniman.ac.id', 'Sistem Informasi', 1, 'aktif', '2025-08-01', 'Jl. Raya Barat No. 102', '081234567902'],
        ['202501003', 'Citra Dewi', 'citra.dewi@uniman.ac.id', 'Teknik Elektro', 1, 'aktif', '2025-08-01', 'Jl. Raya Selatan No. 103', '081234567903'],
        ['202501004', 'Dimas Ramadhan', 'dimas.ramadhan@uniman.ac.id', 'Manajemen', 1, 'aktif', '2025-08-01', 'Jl. Raya Utara No. 104', '081234567904'],
        ['202501005', 'Eka Maharani', 'eka.maharani@uniman.ac.id', 'Akuntansi', 1, 'aktif', '2025-08-01', 'Jl. Raya Tengah No. 105', '081234567905'],
        ['202501006', 'Fadil Hakim', 'fadil.hakim@uniman.ac.id', 'Psikologi', 1, 'aktif', '2025-08-01', 'Jl. Raya Indah No. 106', '081234567906'],
        ['202501007', 'Gita Permata', 'gita.permata@uniman.ac.id', 'Teknik Mesin', 1, 'aktif', '2025-08-01', 'Jl. Raya Sejahtera No. 107', '081234567907'],
        ['202501008', 'Hadi Santoso', 'hadi.santoso@uniman.ac.id', 'Bahasa Inggris', 1, 'aktif', '2025-08-01', 'Jl. Raya Maju No. 108', '081234567908'],
        ['202501009', 'Indri Lestari', 'indri.lestari@uniman.ac.id', 'Teknik Sipil', 1, 'aktif', '2025-08-01', 'Jl. Raya Jaya No. 109', '081234567909'],
        ['202501010', 'Joko Widodo', 'joko.widodo@uniman.ac.id', 'Farmasi', 1, 'aktif', '2025-08-01', 'Jl. Raya Harapan No. 110', '081234567910'],
        ['202501011', 'Kania Sari', 'kania.sari@uniman.ac.id', 'Kedokteran', 1, 'aktif', '2025-08-01', 'Jl. Raya Bahagia No. 111', '081234567911'],
        ['202501012', 'Lukman Ahmad', 'lukman.ahmad@uniman.ac.id', 'Keperawatan', 1, 'aktif', '2025-08-01', 'Jl. Raya Sukses No. 112', '081234567912'],
        ['202501013', 'Maya Indah', 'maya.indah@uniman.ac.id', 'Biologi', 1, 'aktif', '2025-08-01', 'Jl. Raya Damai No. 113', '081234567913'],
        ['202501014', 'Nanda Pratama', 'nanda.pratama@uniman.ac.id', 'Kimia', 1, 'aktif', '2025-08-01', 'Jl. Raya Berkah No. 114', '081234567914'],
        ['202501015', 'Omar Bakri', 'omar.bakri@uniman.ac.id', 'Fisika', 1, 'aktif', '2025-08-01', 'Jl. Raya Rezeki No. 115', '081234567915'],
        ['202501016', 'Putri Maharani', 'putri.maharani@uniman.ac.id', 'Matematika', 1, 'aktif', '2025-08-01', 'Jl. Raya Ceria No. 116', '081234567916'],
        ['202501017', 'Qori Santoso', 'qori.santoso@uniman.ac.id', 'Sastra Indonesia', 1, 'aktif', '2025-08-01', 'Jl. Raya Gemilang No. 117', '081234567917'],
        ['202501018', 'Rina Dewi', 'rina.dewi@uniman.ac.id', 'Ilmu Komunikasi', 1, 'aktif', '2025-08-01', 'Jl. Raya Cemerlang No. 118', '081234567918'],
        ['202501019', 'Satria Budi', 'satria.budi@uniman.ac.id', 'Arsitektur', 1, 'aktif', '2025-08-01', 'Jl. Raya Mulia No. 119', '081234567919'],
        ['202501020', 'Tina Sari', 'tina.sari@uniman.ac.id', 'Hukum', 1, 'aktif', '2025-08-01', 'Jl. Raya Makmur No. 120', '081234567920'],
        ['202501021', 'Udin Setiawan', 'udin.setiawan@uniman.ac.id', 'Ekonomi', 1, 'aktif', '2025-08-01', 'Jl. Raya Sentosa No. 121', '081234567921'],
        ['202501022', 'Vera Lestari', 'vera.lestari@uniman.ac.id', 'Teknik Informatika', 1, 'aktif', '2025-08-01', 'Jl. Raya Harmoni No. 122', '081234567922'],
        ['202501023', 'Wawan Kurniawan', 'wawan.kurniawan@uniman.ac.id', 'Sistem Informasi', 1, 'aktif', '2025-08-01', 'Jl. Raya Sejati No. 123', '081234567923'],
        ['202501024', 'Xenia Putri', 'xenia.putri@uniman.ac.id', 'Manajemen', 1, 'aktif', '2025-08-01', 'Jl. Raya Asri No. 124', '081234567924'],
        ['202501025', 'Yoga Aditya', 'yoga.aditya@uniman.ac.id', 'Teknik Elektro', 1, 'aktif', '2025-08-01', 'Jl. Raya Elok No. 125', '081234567925']
    ];
    
    echo "📝 Memulai penambahan 25 mahasiswa baru (angkatan 2025)...\n\n";
    
    // Prepare statement untuk insert
    $sql = "INSERT INTO mahasiswa (nim, nama, email, jurusan, semester, status, tanggal_masuk, alamat, telepon, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $stmt = $pdo->prepare($sql);
    
    $success_count = 0;
    $error_count = 0;
    
    foreach ($mahasiswa_baru as $index => $mhs) {
        try {
            $stmt->execute([
                $mhs[0], // nim
                $mhs[1], // nama
                $mhs[2], // email
                $mhs[3], // jurusan
                $mhs[4], // semester
                $mhs[5], // status
                $mhs[6], // tanggal_masuk
                $mhs[7], // alamat
                $mhs[8]  // telepon
            ]);
            
            $success_count++;
            echo "✅ " . ($index + 1) . ". {$mhs[1]} (NIM: {$mhs[0]}) - {$mhs[3]}\n";
            
        } catch (PDOException $e) {
            $error_count++;
            echo "❌ " . ($index + 1) . ". Error adding {$mhs[1]}: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n" . str_repeat('=', 60) . "\n";
    echo "📊 HASIL PENAMBAHAN DATA:\n";
    echo "✅ Berhasil ditambahkan: {$success_count} mahasiswa\n";
    echo "❌ Gagal ditambahkan: {$error_count} mahasiswa\n";
    
    // Cek jumlah total setelah penambahan
    $stmt = $pdo->query("SELECT COUNT(*) FROM mahasiswa");
    $new_total = $stmt->fetchColumn();
    echo "📈 Total mahasiswa sekarang: {$new_total} orang\n";
    echo "📊 Penambahan: " . ($new_total - $current_count) . " mahasiswa baru\n\n";
    
    // Tampilkan statistik terbaru
    echo "📋 STATISTIK DATABASE TERBARU:\n";
    echo str_repeat('-', 50) . "\n";
    
    // Distribusi per jurusan
    echo "\n🎓 DISTRIBUSI PER JURUSAN:\n";
    $stmt = $pdo->query("
        SELECT jurusan, COUNT(*) as jumlah 
        FROM mahasiswa 
        GROUP BY jurusan 
        ORDER BY jumlah DESC, jurusan
    ");
    $distribusi = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($distribusi as $data) {
        echo "• {$data['jurusan']}: {$data['jumlah']} mahasiswa\n";
    }
    
    // Distribusi per semester
    echo "\n📅 DISTRIBUSI PER SEMESTER:\n";
    $stmt = $pdo->query("
        SELECT semester, COUNT(*) as jumlah 
        FROM mahasiswa 
        GROUP BY semester 
        ORDER BY semester
    ");
    $distribusi_semester = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($distribusi_semester as $data) {
        echo "• Semester {$data['semester']}: {$data['jumlah']} mahasiswa\n";
    }
    
    // Distribusi per tahun masuk
    echo "\n🗓️ DISTRIBUSI PER TAHUN MASUK:\n";
    $stmt = $pdo->query("
        SELECT EXTRACT(YEAR FROM tanggal_masuk) as tahun, COUNT(*) as jumlah 
        FROM mahasiswa 
        GROUP BY EXTRACT(YEAR FROM tanggal_masuk) 
        ORDER BY tahun DESC
    ");
    $distribusi_tahun = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($distribusi_tahun as $data) {
        echo "• Angkatan {$data['tahun']}: {$data['jumlah']} mahasiswa\n";
    }
    
    echo "\n✅ Penambahan 25 mahasiswa baru selesai!\n";
    echo "🎉 Database siap dengan total {$new_total} mahasiswa!\n";
    echo "📱 Silakan refresh frontend Anda untuk melihat data terbaru.\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
