<?php
declare(strict_types=1);

namespace App\Benchmark\Domain\Users;

use Throwable;

class InvalidEmail extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}