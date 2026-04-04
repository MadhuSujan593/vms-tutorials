<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::table('migrations')->where('migration', 'like', '%create_courses_table%')->delete();
    echo "Removed 'create_courses_table' from migrations table.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
