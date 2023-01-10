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

class CreatePosts implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $uuid = UUID::random();
            $id = $request->query('uuid');
            $post = $this->postsRepository->get($uuid);
        }
        catch (HttpException | PostNotFoundException $exception ){
            return new ErrorResponse($exception->getMessage());
        }
        $this->postsRepository->save($post);
        return new SuccessResponce(['uuid'=>$id, 'uuid_author'=>$post->getUuidUser(), 'title'=>$post->getTitle(), 'text'=>$post->getText()]);
    }
}