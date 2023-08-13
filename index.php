<?php

declare(strict_types = 1);

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\TransactionsController;
use App\Router;
use App\Utils\FilesManager;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('STORAGE_PATH', __DIR__ . '/storage');
define('VIEW_PATH', __DIR__ . '/views');

$router = new Router();

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/transactions', [TransactionsController::class, 'index'])
    ->get('/download', [FilesManager::class, 'download', ['application/csv', 'sample.csv', dirname(STORAGE_PATH) . '/sample_1.csv']]);

(new App(
    $router,
    ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
    new Config($_ENV)
))->run();
