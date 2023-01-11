<?php
namespace Tgu\Polikarpov\Blog\Repositories\LikesRepository;

use Tgu\Polikarpov\Blog\Likes;

interface LikesRepositoryInterface
{
    public function saveLike(Likes $comment):void;
    public function getByPostUuid(string $uuid_post): Likes;
}