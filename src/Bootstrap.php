<?php
declare(strict_types=1);

namespace App;

use App\Controllers\GetUsersController;
use App\Benchmark\Infrastructure\Database\PdoConnectionPool;
use App\Benchmark\Infrastructure\Users\UserRepositoryPDO;
use App\Benchmark\Application\GetUsersUseCase;
use App\Controllers\HelloWorldController;

class Bootstrap
{
    private array $controllers;


    public function register(): self
    {
        $connectionPool = $this->makeConnectionPool();

        $this->controllers = [
            GetUsersController::class => new GetUsersController(
                new GetUsersUseCase(new UserRepositoryPDO($connectionPool))
            ),
            HelloWorldController::class => new HelloWorldController()
        ];
        return $this;
    }

    public function getControllers(): array
    {
        return $this->controllers;
    }

    private function makeConnectionPool(): PdoConnectionPool
    {
        return new PdoConnectionPool(
            "127.0.0.1",
            3306,
            "benchmark",
            "root",
            "root"
        );
    }

}