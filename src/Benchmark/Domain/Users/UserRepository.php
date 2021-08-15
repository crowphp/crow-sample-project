<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\Users;

use App\Benchmark\Domain\Users\ValueObjects\UserId;

interface UserRepository
{

    public function getUsers(): UsersCollection;

}