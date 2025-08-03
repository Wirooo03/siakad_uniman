<?php
// Simple Laravel bootstrap test
require_once __DIR__ . '/vendor/autoload.php';

echo "🧪 Testing Laravel Bootstrap...\n";

try {
    // Test 1: Basic Laravel app
    $app = require_once __DIR__ . '/bootstrap/app.php';
    echo "✅ Laravel app bootstrapped\n";
    
    // Test 2: Database config
    $config = $app['config'];
    $dbConfig = $config->get('database.connections.sqlite');
    echo "✅ Database config loaded\n";
    echo "Database: " . $dbConfig['database'] . "\n";
    
    // Test 3: Database file exists
    if (file_exists($dbConfig['database'])) {
        echo "✅ SQLite file exists\n";
    } else {
        echo "❌ SQLite file missing: " . $dbConfig['database'] . "\n";
    }
    
    // Test 4: PDO Connection
    $pdo = new PDO('sqlite:' . $dbConfig['database']);
    echo "✅ Direct PDO connection works\n";
    
    // Test 5: Laravel DB Connection
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    $db = $app['db'];
    $connection = $db->connection();
    $pdo = $connection->getPdo();
    echo "✅ Laravel DB connection works\n";
    
    // Test 6: Check tables
    $tables = $connection->select("SELECT name FROM sqlite_master WHERE type='table'");
    echo "📋 Tables found: " . count($tables) . "\n";
    foreach ($tables as $table) {
        echo "   - " . $table->name . "\n";
    }
    
    // Test 7: Test Mahasiswa model
    if (class_exists('App\Models\Mahasiswa')) {
        echo "✅ Mahasiswa model found\n";
        
        // Count records
        $count = $connection->select("SELECT COUNT(*) as count FROM mahasiswa");
        echo "📊 Mahasiswa records: " . $count[0]->count . "\n";
    } else {
        echo "❌ Mahasiswa model not found\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📍 File: " . $e->getFile() . "\n";
    echo "📍 Line: " . $e->getLine() . "\n";
}
?>
