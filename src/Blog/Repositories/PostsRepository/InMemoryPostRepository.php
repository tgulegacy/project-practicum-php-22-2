<?php

namespace Tgu\Polikarpov\Blog\Repositories\PostsRepository;

use PostsRepositoryInterface;
use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\PostNotFoundException;

class InMemoryPostRepository implements PostsRepositoryInterface
{
    private array $posts = [];

    public function save(Post $post):void{
        $this->posts[] = $post;
    }

    public function get(UUID $uuid): Post
    {
        foreach ($this->posts as $post){
            if((string)$post->getUuid() === $uuid)
                return $post;
        }
        throw new PostNotFoundException("Posts not found $uuid");
    }
}