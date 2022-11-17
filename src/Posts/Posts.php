<?php

namespace Tgu\Polikarpov\Posts;

use Tgu\Polikarpov\User\User;

class Posts
{

    public function __construct(
        private int $id,
        private User $user,
        private string $title,
        private string $text,
    )
    {

    }

    public function __toString(): string
    {
        return $this->id . ' ' . $this->user . ' ' . $this->title . ' ' . 
            $this->text;
    }
}
