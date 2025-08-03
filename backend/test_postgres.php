<?php
try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '$H1+$h1+');
    echo "✅ PostgreSQL Connection: SUCCESS\n";
    
    // Test table exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM mahasiswa");
    $count = $stmt->fetchColumn();
    echo "✅ Mahasiswa table exists with {$count} records\n";
    
    // Test sample data
    $stmt = $pdo->query("SELECT nim, nama FROM mahasiswa LIMIT 3");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "📋 Sample: {$row['nim']} - {$row['nama']}\n";
    }
    
} catch(Exception $e) {
    echo "❌ PostgreSQL Error: " . $e->getMessage() . "\n";
}
?>do = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', 'admin');
    echo "✅ PostgreSQL Connection: SUCCESS\n";
    
    // Test table exists
    $stmt = $pdo->query("SELECT COUNT(*) FROM mahasiswa");
    $count = $stmt->fetchColumn();
    echo "✅ Mahasiswa table exists with {$count} records\n";
    
    // Test sample data
    $stmt = $pdo->query("SELECT nim, nama FROM mahasiswa LIMIT 3");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "📋 Sample: {$row['nim']} - {$row['nama']}\n";
    }
    
} catch(Exception $e) {
    echo "❌ PostgreSQL Error: " . $e->getMessage() . "\n";
}
?>
