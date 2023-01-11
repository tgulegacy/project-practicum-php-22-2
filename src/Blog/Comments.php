<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Blog\Posts;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\User;

class Comments
{

    public function __construct(
        private UUID $uuid,
        private string $id_post,
        private string $id_author,
        private string $text
    )
    {

    }

    public function __toString(): string
    {
        return $this->uuid . ' ' . $this->id_post . ' ' . $this->id_author . ' ' .
            $this->text;
    }
    public function getUuidComment():UUID{
        return $this->uuid;
    }
    public function getUuidPost():string{
        return $this->id_post;
    }
    public function getUuidUser():string{
        return $this->id_author;
    }
    public function getTextComment():string{
        return $this->text;
    }
}