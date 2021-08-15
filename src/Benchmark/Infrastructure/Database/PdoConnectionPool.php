<?php
declare(strict_types=1);

namespace App\Benchmark\Infrastructure\Database;

use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;

class PdoConnectionPool
{

    public function __construct(
        private string $host,
        private int    $port,
        private string $db,
        private string $username,
        private string $password
    )
    {
    }

    public function getPool(): PDOPool
    {
        return new PDOPool(
            (new PDOConfig())
                ->withHost($this->host)
                ->withPort($this->port)
                ->withDbName($this->db)
                ->withCharset('utf8mb4')
                ->withUsername($this->username)
                ->withPassword($this->password),
            5
        );
    }

}