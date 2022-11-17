<?php

namespace Tgu\Polikarpov\Comments;

use Tgu\Polikarpov\Posts\Posts;
use Tgu\Polikarpov\User\User;

class Comments
{

    public function __construct(
        private int $id,
        private User $user,
        private Posts $posts,
        private string $text,
    )
    {

    }

    public function __toString(): string
    {
        return $this->id . ' ' . $this->user . ' ' . $this->posts . ' ' .
            $this->text;
    }
}