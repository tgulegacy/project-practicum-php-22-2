<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Exceptions\InvalidArgumentException;

class UUID
{
    public function __construct(
        private string $uuid
    )
    {
        if(!uuid_is_valid($uuid))
        {
            throw new InvalidArgumentException(
                "Maliformed UUID: $this->uuid"
            );
        }
    }
    
    public static function random(): self
    {
        return new self(uuid_create(UUID_TYPE_RANDOM));
    }
    
    public function __toString(): string
    {
        return $this->uuid;
    }
}

