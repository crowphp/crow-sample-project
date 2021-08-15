<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\Users\ValueObjects;

use App\Benchmark\Domain\Users\InvalidEmail;

class Email
{
    private string $email;
    public const EMAIL_LABEL = "email";

    public function __construct(string $email)
    {
        $this->guardAgainstInvalidEmail($email);
        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }

    public function equals(self $email): bool
    {
        return $this->email === $email->value();
    }

    private function guardAgainstInvalidEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmail("${email} is not a valid email");
        }
    }

}