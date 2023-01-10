<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Person\Name;

class User
{

    public function __construct(
        private UUID $uuid,
        private Name $name,
        private string $username,
    )
    {

    }
    
    
    public function __toString(): string
    {
        $uuid = $this->getUuid();
       $firstName=$this->name->getFirstName();
       $lastName=$this->name->getLastName();
       return "Юзер $uuid с именем $firstName $lastName и логином $this->username" 
           . PHP_EOL;
    }
    public function getUuid(): UUID
    {
        return $this->uuid;
    }
    public function getName(): Name
    {
        return $this->name;
    }
    public function getUsername(): string
    {
        return $this->username;
    }
}
