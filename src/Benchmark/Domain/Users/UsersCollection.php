<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\Users;

class UsersCollection
{
    /**
     * @var User[]
     */
    private array $users;

    /**
     * @param User[] $users
     */
    public function __construct(array $users = [])
    {
        $this->users = $this->guardAgainstInvalidArrayItems($users);
    }

    public function add(User $user): self
    {
        $users = $this->users;
        $users[] = $user;
        return new self($users);
    }

    public function toArray(): array
    {
        return $this->users;
    }

    /**
     * @param User[] $users
     * @return User[]
     */
    private function guardAgainstInvalidArrayItems(array $users): array
    {
        return array_map(
            function (User $user) {
                return $user;
            },
            $users
        );
    }

}