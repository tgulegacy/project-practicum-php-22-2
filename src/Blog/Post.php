<?php

namespace Tgu\Polikarpov\Blog;

use Tgu\Polikarpov\Person\Person;

class Post
{

    public function __construct(
        private UUID $id,
        private string $id_author,
        private string $header,
        private string $text,
    )
    {

    }

    public function __toString(): string
    {
        $id=$this->getUuid();
        return "Post $id author $this->id_author with title $this->header and text - $this->text".PHP_EOL;
    }

    public function getUuid():UUID{
        return $this->id;
    }
    public function getUuidUser():string{
        return $this->id_author;
    }
    public function getTitle():string{
        return $this->header;
    }
    public function getText():string{
        return $this->text;
    }
}
