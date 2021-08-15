<?php

declare(strict_types=1);

namespace App\Benchmark\Domain\Users\ValueObjects;

use App\Benchmark\Domain\Users\InvalidName;

class Name
{
    private string $firstname;
    private string $lastname;
    public const FIRSTNAME_LABEL = "firstname";
    public const LASTNAME_LABEL = "lastname";
    public const NAME_LABEL = "name";


    public function __construct(string $firstname, string $lastname)
    {
        $this->guardAgainstInvalidName($firstname, $lastname);
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function getName(): string
    {
        return sprintf("%s %s", $this->firstname, $this->lastname);
    }

    public function firstname(): string
    {
        return $this->firstname;
    }

    public function lastname(): string
    {
        return $this->lastname;
    }

    public function equals(self $name): bool
    {
        return ($this->firstname === $name->firstname() && $this->lastname == $name->lastname());
    }

    private function guardAgainstInvalidName(string $firstname, string $lastname)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstname)
            || !preg_match("/^[a-zA-Z-' ]*$/", $lastname)) {
            throw new InvalidName("Only letters and white space allowed");
        }
    }

}