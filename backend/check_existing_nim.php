<?php
echo "=== CEK NIM YANG SUDAH ADA ===\n\n";

try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '$H1+$h1+');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT nim, nama FROM mahasiswa ORDER BY nim");
    $existing_nims = [];
    
    echo "📋 NIM yang sudah ada:\n";
    echo str_repeat('-', 40) . "\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "• {$row['nim']} - {$row['nama']}\n";
        $existing_nims[] = $row['nim'];
    }
    
    echo "\n📊 Total NIM yang sudah ada: " . count($existing_nims) . "\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
