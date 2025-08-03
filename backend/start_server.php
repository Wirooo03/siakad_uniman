<?php
// Simple server starter to bypass PSY/PSYSH issues
require_once __DIR__.'/vendor/autoload.php';

// Start Laravel app
$app = require_once __DIR__.'/bootstrap/app.php';

// Get kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Handle request
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
