<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\Users;

use App\Benchmark\Domain\Users\ValueObjects\Email;
use App\Benchmark\Domain\Users\ValueObjects\Name;
use App\Benchmark\Domain\Users\ValueObjects\UserId;

class User
{

    public function __construct(
        private UserId $userId,
        private Name   $name,
        private Email  $email
    )
    {
    }


    public function getUserId(): UserId
    {
        return $this->userId;
    }


    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            UserId::USERID_LABEL => $this->getUserId()->value(),
            Name::NAME_LABEL => $this->getName()->getName(),
            Email::EMAIL_LABEL => $this->getEmail()->value()
        ];
    }


}