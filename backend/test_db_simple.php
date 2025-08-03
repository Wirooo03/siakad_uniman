<?php
// Simple database connection test
try {
    $host = '127.0.0.1';
    $port = '3306';
    $database = 'siakad_uniman';
    $username = 'root';
    $password = '';
    
    $dsn = "mysql:host=$host;port=$port;dbname=$database";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!\n";
    echo "Host: $host\n";
    echo "Database: $database\n";
    
    // Test if mahasiswa table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'mahasiswa'");
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
            echo "📋 No data found - run seeder\n";
        }
    } else {
        echo "❌ Mahasiswa table does not exist!\n";
        echo "💡 Available tables:\n";
        $stmt = $pdo->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        foreach ($tables as $table) {
            echo "   - $table\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    
    // Try to connect without database name to check if MySQL is running
    try {
        $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
        echo "✅ MySQL server is running\n";
        echo "❌ Database '$database' might not exist\n";
        echo "💡 Create database: CREATE DATABASE $database;\n";
        
        // Show available databases
        $stmt = $pdo->query("SHOW DATABASES");
        $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
        echo "📋 Available databases:\n";
        foreach ($databases as $db) {
            echo "   - $db\n";
        }
    } catch (PDOException $e2) {
        echo "❌ MySQL server is not running or credentials are wrong\n";
        echo "❌ Error: " . $e2->getMessage() . "\n";
    }
}
?>
