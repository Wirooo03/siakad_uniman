<?php
echo "=== TEST PAGINATION DENGAN PER_PAGE ===\n\n";

$endpoints = [
    'http://127.0.0.1:8000/api/mahasiswa',
    'http://127.0.0.1:8000/api/mahasiswa?per_page=25',
    'http://127.0.0.1:8000/api/mahasiswa?page=2&per_page=25',
    'http://127.0.0.1:8000/api/mahasiswa?per_page=50'
];

foreach ($endpoints as $endpoint) {
    echo "🔗 Testing: {$endpoint}\n";
    echo str_repeat('-', 60) . "\n";
    
    try {
        $response = file_get_contents($endpoint);
        if ($response) {
            $data = json_decode($response, true);
            
            if (isset($data['meta'])) {
                echo "✅ Response berhasil!\n";
                echo "📊 Current Page: " . $data['meta']['current_page'] . "\n";
                echo "📊 Per Page: " . $data['meta']['per_page'] . "\n";
                echo "📊 Total: " . $data['meta']['total'] . "\n";
                echo "📊 Last Page: " . $data['meta']['last_page'] . "\n";
                echo "📊 From: " . $data['meta']['from'] . "\n";
                echo "📊 To: " . $data['meta']['to'] . "\n";
                echo "👥 Data Count: " . count($data['data']) . "\n";
            } else {
                echo "❌ No meta information\n";
            }
        } else {
            echo "❌ No response\n";
        }
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}

echo "✅ Test selesai!\n";
