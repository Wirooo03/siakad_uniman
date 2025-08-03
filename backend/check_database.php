<?php
require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = require_once __DIR__ . '/bootstrap/app.php';
    
    echo "=== CHECKING DATABASE CONNECTION ===\n";
    
    // Test database connection
    $pdo = new PDO(
        'pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman',
        'postgres',
        '$H1+$h1+'
    );
    
    echo "✓ Database connection successful\n";
    
    // Check existing mahasiswa count
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM mahasiswa");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Current mahasiswa count: " . $result['total'] . "\n";
    
    // Check columns in mahasiswa table
    echo "\n=== CHECKING TABLE STRUCTURE ===\n";
    $stmt = $pdo->query("SELECT column_name FROM information_schema.columns WHERE table_name = 'mahasiswa' ORDER BY ordinal_position");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Mahasiswa table has " . count($columns) . " columns\n";
    
    // Check for specific new columns
    $newColumns = ['nik', 'jenis_kelamin', 'tempat_lahir', 'program_studi', 'konsentrasi'];
    foreach ($newColumns as $col) {
        if (in_array($col, $columns)) {
            echo "✓ Column '$col' exists\n";
        } else {
            echo "✗ Column '$col' missing\n";
        }
    }
    
    // Check for null values in key fields
    echo "\n=== CHECKING NULL VALUES ===\n";
    $checkColumns = ['nik', 'jenis_kelamin', 'tempat_lahir', 'program_studi', 'sks_total', 'ipk'];
    foreach ($checkColumns as $col) {
        if (in_array($col, $columns)) {
            $stmt = $pdo->prepare("SELECT COUNT(*) as null_count FROM mahasiswa WHERE $col IS NULL");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "Column '$col' has " . $result['null_count'] . " NULL values\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
?>
