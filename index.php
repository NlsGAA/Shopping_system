<?php
require_once __DIR__ . ('/app/core/Core.php');
require_once __DIR__ . ('/routes/router.php');

use App\Core\Core;

try {
    $core = new Core();
    $core->run($routes);
} catch (\Throwable $e) {
    echo $e->getMessage();
}