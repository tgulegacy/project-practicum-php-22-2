<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;

class Posts
{

    public function __construct(
        private UUID $uuid,
        private User $user,
        private string $title,
        private string $text,
    )
    {

    }

    public function __toString(): string
    {
        return $this->uuid . ' ' . $this->user . ' ' . $this->title . ' ' . 
            $this->text;
    }
}
