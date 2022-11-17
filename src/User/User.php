<?php

namespace Tgu\Polikarpov\User;

class User
{

    public function __construct(
        private int $id,
        private string $firstName,
        private string $lastName,
    )
    {

    }

    public function __toString(): string
    {
        return $this->id . ' ' . $this->firstName . ' ' . $this->lastName;
    }
}
