<?php

use Tgu\Polikarpov\Blog\Comments;
use Tgu\Polikarpov\Blog\UUID;

interface CommentsRepositoryInterface
{
    public function save(Comments $comment): void;
    public function get(UUID $uuid): Comments;
}