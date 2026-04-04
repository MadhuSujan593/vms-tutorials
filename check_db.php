<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    $tables = DB::select('SHOW TABLES');
    echo "Tables in database:\n";
    foreach ($tables as $table) {
        echo "- " . current((array)$table) . "\n";
    }
    
    if (Schema::hasTable('courses')) {
        echo "\n'courses' table EXISTS.\n";
    } else {
        echo "\n'courses' table DOES NOT exist.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
