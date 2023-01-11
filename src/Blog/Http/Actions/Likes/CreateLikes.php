<?php

namespace Tgu\Polikarpov\Blog\Http\Actions\Likes;

use Tgu\Polikarpov\Blog\Http\Actions\ActionInterface;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Likes;
use Tgu\Polikarpov\Blog\Repositories\LikesRepository\LikesRepositoryInterface;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\HttpException;

class CreateLikes implements ActionInterface
{
    public function __construct(
        private LikesRepositoryInterface $likesRepository
    )
    {
    }
    public function handle(Request $request): Response
    {
        try {
            $newUuid = UUID::random();
            $like= new Likes($newUuid, $request->jsonBodyField('uuid_post'), $request->jsonBodyField('uuid_user'));
        }
        catch (HttpException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->likesRepository->saveLike($like);
        return new SuccessResponce(['uuid'=>(string)$newUuid]);
    }
}