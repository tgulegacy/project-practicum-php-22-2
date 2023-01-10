<?php

namespace Tgu\Polikarpov\Blog\Repositories\PostsRepository;

use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\UUID;

interface PostsRepositoryInterface
{
    public function save(Post $post): void;
    public function get(UUID $uuid): Post;
}