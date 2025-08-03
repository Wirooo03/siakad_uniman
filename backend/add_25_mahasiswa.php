<?php
echo "=== MENAMBAH 25 MAHASISWA BARU ===\n\n";

try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '$H1+$h1+');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Koneksi PostgreSQL berhasil!\n\n";
    
    // Cek jumlah mahasiswa saat ini
    $stmt = $pdo->query("SELECT COUNT(*) FROM mahasiswa");
    $current_count = $stmt->fetchColumn();
    echo "📊 Jumlah mahasiswa saat ini: {$current_count}\n\n";
    
    // Data mahasiswa baru (25 orang)
    $mahasiswa_baru = [
        ['456789123', 'Andi Pratama', 'andi.pratama@uniman.ac.id', 'Teknik Informatika', 3, 'aktif', '2023-08-01', 'Jl. Merdeka No. 15', '081234567801'],
        ['789123456', 'Dewi Sartika', 'dewi.sartika@uniman.ac.id', 'Sistem Informasi', 5, 'aktif', '2021-08-01', 'Jl. Sudirman No. 22', '081234567802'],
        ['321654987', 'Rizki Ramadhan', 'rizki.ramadhan@uniman.ac.id', 'Teknik Elektro', 2, 'aktif', '2024-08-01', 'Jl. Diponegoro No. 8', '081234567803'],
        ['654987321', 'Maya Sari', 'maya.sari@uniman.ac.id', 'Manajemen', 4, 'aktif', '2022-08-01', 'Jl. Gatot Subroto No. 33', '081234567804'],
        ['147258369', 'Fajar Nugroho', 'fajar.nugroho@uniman.ac.id', 'Akuntansi', 6, 'aktif', '2020-08-01', 'Jl. Ahmad Yani No. 17', '081234567805'],
        ['369258147', 'Sinta Maharani', 'sinta.maharani@uniman.ac.id', 'Psikologi', 1, 'aktif', '2025-08-01', 'Jl. Veteran No. 45', '081234567806'],
        ['258147369', 'Bayu Setiawan', 'bayu.setiawan@uniman.ac.id', 'Teknik Mesin', 3, 'aktif', '2023-08-01', 'Jl. Pahlawan No. 12', '081234567807'],
        ['741852963', 'Lestari Indah', 'lestari.indah@uniman.ac.id', 'Bahasa Inggris', 5, 'aktif', '2021-08-01', 'Jl. Kemerdekaan No. 88', '081234567808'],
        ['852963741', 'Doni Hermawan', 'doni.hermawan@uniman.ac.id', 'Teknik Sipil', 2, 'aktif', '2024-08-01', 'Jl. Proklamasi No. 56', '081234567809'],
        ['963741852', 'Ayu Lestari', 'ayu.lestari@uniman.ac.id', 'Farmasi', 4, 'aktif', '2022-08-01', 'Jl. Pancasila No. 23', '081234567810'],
        ['159753486', 'Hendra Gunawan', 'hendra.gunawan@uniman.ac.id', 'Kedokteran', 7, 'aktif', '2019-08-01', 'Jl. Garuda No. 34', '081234567811'],
        ['486159753', 'Nurul Hidayah', 'nurul.hidayah@uniman.ac.id', 'Keperawatan', 3, 'aktif', '2023-08-01', 'Jl. Budi Utomo No. 67', '081234567812'],
        ['753486159', 'Yoga Pratama', 'yoga.pratama@uniman.ac.id', 'Teknik Informatika', 5, 'aktif', '2021-08-01', 'Jl. Kartini No. 19', '081234567813'],
        ['123789456', 'Ratna Sari', 'ratna.sari@uniman.ac.id', 'Sistem Informasi', 1, 'aktif', '2025-08-01', 'Jl. Cut Nyak Dien No. 41', '081234567814'],
        ['456123789', 'Agus Salim', 'agus.salim@uniman.ac.id', 'Hukum', 6, 'aktif', '2020-08-01', 'Jl. Hasanuddin No. 52', '081234567815'],
        ['789456123', 'Winda Sari', 'winda.sari@uniman.ac.id', 'Ekonomi', 2, 'aktif', '2024-08-01', 'Jl. Teuku Umar No. 76', '081234567816'],
        ['321987654', 'Irfan Hakim', 'irfan.hakim@uniman.ac.id', 'Teknik Elektro', 4, 'aktif', '2022-08-01', 'Jl. Sultan Agung No. 29', '081234567817'],
        ['654321987', 'Putri Ayu', 'putri.ayu@uniman.ac.id', 'Arsitektur', 3, 'aktif', '2023-08-01', 'Jl. Imam Bonjol No. 63', '081234567818'],
        ['987654321', 'Wahyu Santoso', 'wahyu.santoso@uniman.ac.id', 'Teknik Mesin', 5, 'cuti', '2021-08-01', 'Jl. Gajah Mada No. 18', '081234567819'],
        ['135792468', 'Diana Permata', 'diana.permata@uniman.ac.id', 'Biologi', 1, 'aktif', '2025-08-01', 'Jl. Majapahit No. 44', '081234567820'],
        ['468135792', 'Rudi Hartono', 'rudi.hartono@uniman.ac.id', 'Kimia', 7, 'aktif', '2019-08-01', 'Jl. Sriwijaya No. 37', '081234567821'],
        ['792468135', 'Sari Dewi', 'sari.dewi@uniman.ac.id', 'Fisika', 2, 'aktif', '2024-08-01', 'Jl. Brawijaya No. 58', '081234567822'],
        ['246813579', 'Tommy Wijaya', 'tommy.wijaya@uniman.ac.id', 'Matematika', 4, 'aktif', '2022-08-01', 'Jl. Singhasari No. 71', '081234567823'],
        ['579246813', 'Eka Putri', 'eka.putri@uniman.ac.id', 'Sastra Indonesia', 6, 'aktif', '2020-08-01', 'Jl. Airlangga No. 25', '081234567824'],
        ['813579246', 'Ferry Setiawan', 'ferry.setiawan@uniman.ac.id', 'Ilmu Komunikasi', 3, 'aktif', '2023-08-01', 'Jl. Hang Tuah No. 92', '081234567825']
    ];
    
    echo "📝 Memulai penambahan 25 mahasiswa baru...\n\n";
    
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
            echo "✅ " . ($index + 1) . ". {$mhs[1]} (NIM: {$mhs[0]}) - {$mhs[3]} semester {$mhs[4]}\n";
            
        } catch (PDOException $e) {
            $error_count++;
            echo "❌ " . ($index + 1) . ". Error adding {$mhs[1]}: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n" . str_repeat('=', 50) . "\n";
    echo "📊 HASIL PENAMBAHAN DATA:\n";
    echo "✅ Berhasil ditambahkan: {$success_count} mahasiswa\n";
    echo "❌ Gagal ditambahkan: {$error_count} mahasiswa\n";
    
    // Cek jumlah total setelah penambahan
    $stmt = $pdo->query("SELECT COUNT(*) FROM mahasiswa");
    $new_total = $stmt->fetchColumn();
    echo "📈 Total mahasiswa sekarang: {$new_total} orang\n";
    echo "📊 Penambahan: " . ($new_total - $current_count) . " mahasiswa baru\n\n";
    
    // Tampilkan distribusi per jurusan
    echo "📋 DISTRIBUSI PER JURUSAN:\n";
    echo str_repeat('-', 40) . "\n";
    $stmt = $pdo->query("
        SELECT jurusan, COUNT(*) as jumlah 
        FROM mahasiswa 
        GROUP BY jurusan 
        ORDER BY jumlah DESC
    ");
    $distribusi = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($distribusi as $data) {
        echo "• {$data['jurusan']}: {$data['jumlah']} mahasiswa\n";
    }
    
    // Tampilkan distribusi per semester
    echo "\n📅 DISTRIBUSI PER SEMESTER:\n";
    echo str_repeat('-', 40) . "\n";
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
    
    // Tampilkan distribusi per status
    echo "\n📊 DISTRIBUSI PER STATUS:\n";
    echo str_repeat('-', 40) . "\n";
    $stmt = $pdo->query("
        SELECT status, COUNT(*) as jumlah 
        FROM mahasiswa 
        GROUP BY status 
        ORDER BY jumlah DESC
    ");
    $distribusi_status = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($distribusi_status as $data) {
        echo "• Status {$data['status']}: {$data['jumlah']} mahasiswa\n";
    }
    
    echo "\n✅ Penambahan 25 mahasiswa selesai!\n";
    echo "🎉 Database siap digunakan dengan data yang lebih lengkap!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
