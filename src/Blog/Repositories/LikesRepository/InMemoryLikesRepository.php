<?php

namespace Tgu\Polikarpov\Blog\Repositories\LikesRepository;

use Tgu\Polikarpov\Blog\Likes;
use Tgu\Polikarpov\Blog\Exceptions\LikeNotFoundException;

class InMemoryLikesRepository implements LikesRepositoryInterface
{
    private array $likes = [];

    public function saveLike(Likes $likes):void{
        $this->likes[] = $likes;
    }


    /**
     * @throws LikeNotFoundException
     */
    public function getByPostUuid(string $uuid_post): Likes
    {
        foreach ($this->likes as $like){
            if((string)$like->getUuidPost() === $uuid_post)
                return $like;
        }
        throw new LikeNotFoundException("Like not found $uuid_post");
    }
}