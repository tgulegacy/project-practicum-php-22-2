<?php

namespace Tgu\Polikarpov\Blog\Repositories\CommentsRepository;

use CommentsRepositoryInterface;
use Tgu\Polikarpov\Blog\Comments;
use Tgu\Polikarpov\Blog\Exceptions\CommentNotFoundException;
use Tgu\Polikarpov\Blog\UUID;

class InMemoryCommentsRepository implements CommentsRepositoryInterface
{
    private array $comments = [];

    public function save(Comments $comment):void{
        $this->comments[] = $comment;
    }

    public function getByUuidComment(UUID $uuid_comment): Comments
    {
        foreach ($this->comments as $comment){
            if((string)$comment->getUuid() === $uuid_comment)
                return $comment;
        }
        throw new CommentNotFoundException("Users not found $uuid_comment");
    }

    public function get(UUID $uuid): Comments
    {
        // TODO: Implement get() method.
    }
}