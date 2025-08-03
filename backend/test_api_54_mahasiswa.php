<?php
echo "=== TEST API ENDPOINT DENGAN 54 MAHASISWA ===\n\n";

// Test health check endpoint
echo "🏥 Testing Health Check Endpoint...\n";
try {
    $health_response = file_get_contents('http://127.0.0.1:8000/api/health');
    if ($health_response) {
        $health_data = json_decode($health_response, true);
        echo "✅ Health Check: " . json_encode($health_data, JSON_PRETTY_PRINT) . "\n\n";
    } else {
        echo "❌ Health Check: Server tidak merespons\n\n";
    }
} catch (Exception $e) {
    echo "❌ Health Check Error: " . $e->getMessage() . "\n\n";
}

// Test mahasiswa endpoint
echo "👥 Testing Mahasiswa Endpoint...\n";
try {
    $api_response = file_get_contents('http://127.0.0.1:8000/api/mahasiswa');
    if ($api_response) {
        $api_data = json_decode($api_response, true);
        
        if ($api_data && isset($api_data['data'])) {
            echo "✅ API Response berhasil!\n";
            echo "📊 Status: " . ($api_data['status'] ?? 'unknown') . "\n";
            echo "📝 Message: " . ($api_data['message'] ?? 'no message') . "\n";
            echo "👥 Total mahasiswa: " . count($api_data['data']) . "\n";
            
            if (isset($api_data['meta'])) {
                echo "📄 Meta info: " . json_encode($api_data['meta']) . "\n";
            }
            
            echo "\n📋 Sample data (5 mahasiswa pertama):\n";
            echo str_repeat('-', 80) . "\n";
            echo sprintf("%-12s | %-20s | %-20s | %-10s\n", "NIM", "Nama", "Jurusan", "Semester");
            echo str_repeat('-', 80) . "\n";
            
            for ($i = 0; $i < min(5, count($api_data['data'])); $i++) {
                $mhs = $api_data['data'][$i];
                echo sprintf("%-12s | %-20s | %-20s | %-10s\n", 
                    $mhs['nim'] ?? 'N/A',
                    substr($mhs['nama'] ?? 'N/A', 0, 20),
                    substr($mhs['jurusan'] ?? 'N/A', 0, 20),
                    $mhs['semester'] ?? 'N/A'
                );
            }
            
            echo "\n📋 Sample mahasiswa angkatan 2025 (NIM 2025xxxxx):\n";
            echo str_repeat('-', 80) . "\n";
            $angkatan_2025 = array_filter($api_data['data'], function($mhs) {
                return strpos($mhs['nim'], '2025') === 0;
            });
            
            if (!empty($angkatan_2025)) {
                echo sprintf("%-12s | %-20s | %-20s | %-10s\n", "NIM", "Nama", "Jurusan", "Semester");
                echo str_repeat('-', 80) . "\n";
                
                $count = 0;
                foreach ($angkatan_2025 as $mhs) {
                    if ($count >= 5) break;
                    echo sprintf("%-12s | %-20s | %-20s | %-10s\n", 
                        $mhs['nim'] ?? 'N/A',
                        substr($mhs['nama'] ?? 'N/A', 0, 20),
                        substr($mhs['jurusan'] ?? 'N/A', 0, 20),
                        $mhs['semester'] ?? 'N/A'
                    );
                    $count++;
                }
                echo "\n🎉 Total mahasiswa angkatan 2025: " . count($angkatan_2025) . "\n";
            } else {
                echo "❌ Tidak ditemukan mahasiswa angkatan 2025\n";
            }
            
        } else {
            echo "❌ Format response tidak sesuai: " . substr($api_response, 0, 200) . "...\n";
        }
    } else {
        echo "❌ API tidak merespons\n";
    }
} catch (Exception $e) {
    echo "❌ API Error: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat('=', 60) . "\n";
echo "✅ Test API selesai!\n";
echo "📱 Silakan buka frontend di: http://localhost:3000/siakad/list_mahasiswa\n";
echo "🔄 Refresh halaman untuk melihat 54 mahasiswa terbaru!\n";
