<?php

namespace Tgu\Polikarpov\Blog\Http\Actions\Posts;

use Tgu\Polikarpov\Blog\Exceptions\PostNotFoundException;
use Tgu\Polikarpov\Blog\Http\Actions\ActionInterface;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\Repositories\PostsRepository\PostsRepositoryInterface;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\HttpException;

class DeletePost implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    )
    {
    }
    public function handle(Request $request): Response
    {
        try {
            $uuid = $request->query('uuid');
        }
        catch (HttpException | PostNotFoundException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->postsRepository->get($uuid);
        return new SuccessResponce(['uuid'=>$uuid]);
    }
}