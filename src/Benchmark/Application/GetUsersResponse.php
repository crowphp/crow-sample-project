<?php
declare(strict_types=1);

namespace App\Benchmark\Application;

use App\Benchmark\Domain\Users\UsersCollection;
use App\Benchmark\Domain\Users\User;

class GetUsersResponse
{
    public function __construct(private UsersCollection $collection)
    {
    }

    public function toArray(): array
    {
        return array_map(
            function (User $user){
                return $user->toArray();
            },
            $this->collection->toArray()
        );
    }

}