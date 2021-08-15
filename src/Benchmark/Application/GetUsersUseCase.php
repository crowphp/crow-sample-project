<?php

declare(strict_types=1);

namespace App\Benchmark\Application;

use App\Benchmark\Domain\Users\User;
use App\Benchmark\Domain\Users\UserRepository;
use App\Benchmark\Domain\Users\ValueObjects\UserId;

class GetUsersUseCase
{
    public function __construct(private UserRepository $repository)
    {
    }

    public function execute(): GetUsersResponse
    {
        return new GetUsersResponse($this->repository->getUsers(
        ));
    }
}