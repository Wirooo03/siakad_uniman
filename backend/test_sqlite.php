<?php
// Test SQLite connection
try {
    $database_path = __DIR__ . '/database/database.sqlite';
    
    echo "🔍 Testing SQLite connection...\n";
    echo "Database path: $database_path\n";
    
    if (!file_exists($database_path)) {
        echo "❌ SQLite file does not exist!\n";
        echo "💡 Creating database file...\n";
        touch($database_path);
    }
    
    $pdo = new PDO("sqlite:$database_path");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ SQLite connection successful!\n";
    
    // Test if mahasiswa table exists
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='mahasiswa'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Mahasiswa table exists!\n";
        
        // Count records
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM mahasiswa");
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "📊 Total mahasiswa records: " . $count['count'] . "\n";
        
        if ($count['count'] > 0) {
            // Get sample data
            $stmt = $pdo->query("SELECT * FROM mahasiswa LIMIT 3");
            $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "📋 Sample data:\n";
            foreach ($samples as $sample) {
                echo "   - " . $sample['nama'] . " (" . $sample['nim'] . ")\n";
            }
        } else {
            echo "📋 No data found\n";
        }
    } else {
        echo "❌ Mahasiswa table does not exist!\n";
        echo "💡 Available tables:\n";
        $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}
?>
