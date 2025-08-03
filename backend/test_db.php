<?php
// Test PostgreSQL database connection directly
require_once 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    // Test PostgreSQL connection
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '');
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
    $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_DATABASE'];
    $pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!\n";
    echo "Host: " . $_ENV['DB_HOST'] . "\n";
    echo "Database: " . $_ENV['DB_DATABASE'] . "\n";
    
    // Test if mahasiswa table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'mahasiswa'");
    if ($stmt->rowCount() > 0) {
        echo "✅ Mahasiswa table exists!\n";
        
        // Count records
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM mahasiswa");
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "📊 Total mahasiswa records: " . $count['count'] . "\n";
        
        // Get sample data
        $stmt = $pdo->query("SELECT * FROM mahasiswa LIMIT 3");
        $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "📋 Sample data:\n";
        foreach ($samples as $sample) {
            echo "   - " . $sample['nama'] . " (" . $sample['nim'] . ")\n";
        }
    } else {
        echo "❌ Mahasiswa table does not exist!\n";
        echo "💡 Run: php artisan migrate:fresh --seed\n";
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "💡 Check your .env file database settings\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
