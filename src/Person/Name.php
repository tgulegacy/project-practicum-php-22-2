<?php

namespace Tgu\Polikarpov\Person;

class Name
{
    
    public function __construct(
        private string $firstName,
        private string $lastName,
    )
    {
        
    }
    
    public function __toString(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
}