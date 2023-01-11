<?php

namespace Tgu\Polikarpov\Blog\Http\Actions\Posts;

use Tgu\Polikarpov\Blog\Http\Actions\ActionInterface;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\Repositories\PostsRepository\PostsRepositoryInterface;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\HttpException;

class CreatePost implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    )
    {

    }

    public function handle(Request $request): Response
    {
        try {
            $newPostUuid = UUID::random();
            $post = new Post($newPostUuid, $request->jsonBodyField('uuid_author'), $request->jsonBodyField('title'), $request->jsonBodyField('text'));
        }
        catch (HttpException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->postsRepository->save($post);
        return new SuccessResponce(['uuid'=>$newPostUuid]);
    }
}