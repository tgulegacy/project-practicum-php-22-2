<?php

namespace Tgu\Polikarpov\Blog\Http\Actions\Comments;

use Tgu\Polikarpov\Blog\Comments;
use Tgu\Polikarpov\Blog\Http\Actions\ActionInterface;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Repositories\CommentsRepository\CommentsRepositoryInterface;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\HttpException;

class CreateComment implements ActionInterface
{
    public function __construct(
        private CommentsRepositoryInterface $commentsRepository
    )
    {

    }

    public function handle(Request $request): Response
    {
        try {
            $newCommentUuid = UUID::random();
            $comment = new Comments($newCommentUuid, $request->jsonBodyField('uuid_post'), $request->jsonBodyField('uuid_author'), $request->jsonBodyField('text'));
        }
        catch (HttpException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->commentsRepository->save($comment);
        return new SuccessResponce(['uuid'=>(string)$newCommentUuid]);
    }
}