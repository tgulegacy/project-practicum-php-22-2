<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Posts;
use Tgu\Polikarpov\Blog\User;

class Comments
{

    public function __construct(
        private UUID $uuid,
        private User $user,
        private Posts $posts,
        private string $text,
    )
    {

    }

    public function __toString(): string
    {
        return $this->uuid . ' ' . $this->user . ' ' . $this->posts . ' ' .
            $this->text;
    }
}