#!/usr/bin/env php
<?php declare(strict_types=1);

if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'UTC');
}


foreach (array(__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('VENDOR', $file);
        break;
    }
}

unset($file);

if (!defined('VENDOR')) {
    fwrite(
        STDERR,
        'You need to set up the project dependencies using Composer:' . PHP_EOL . PHP_EOL .
        '    composer install' . PHP_EOL . PHP_EOL .
        'You can learn all about Composer on https://getcomposer.org/.' . PHP_EOL
    );

    die(1);
}

require VENDOR;

use Crow\Http\Server\Factory as CrowServer;
use Crow\Router\Factory as CrowRouter;
use App\Controllers\GetUsersController;
use App\Controllers\HelloWorldController;
use App\Bootstrap;


$app = CrowServer::create(CrowServer::SWOOLE_SERVER);
$router = CrowRouter::make();

$controllers = (new Bootstrap())->register()->getControllers();


$router->get('/users',
    $controllers[GetUsersController::class]
);

$router->get('/',
    $controllers[HelloWorldController::class]
);


$app->withRouter($router);

$app->on('start', function ($server) {
    echo "Crow server listening on $server->host:$server->port" . PHP_EOL;
});
$app->listen(5005, "0.0.0.0");