<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\Users\ValueObjects;

class UserId
{
    private int $id;
    public const USERID_LABEL = "userId";

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }

}