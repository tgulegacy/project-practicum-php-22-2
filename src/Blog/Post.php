<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Person\Person;

class Post
{

    public function __construct(
        private Person $person,
        private string $text,
    )
    {

    }

    public function __toString(): string
    {
        return $this->person . ' пишет: ' . $this->text;
    }
}
