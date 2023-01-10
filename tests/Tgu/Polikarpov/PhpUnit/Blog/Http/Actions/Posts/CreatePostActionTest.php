<?php

namespace Tgu\Polikarpov\PhpUnit\Blog\Http\Actions\Posts;

use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Http\Actions\Posts\CreatePosts;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\Repositories\PostsRepository\PostsRepositoryInterface;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\PostNotFoundException;

class CreatePostActionTest extends TestCase
{
    private function postRepository(array $posts): PostsRepositoryInterface
    {
        return new class($posts) implements PostsRepositoryInterface {
            public function __construct(
                public array $array
            )
            {
            }

            public function save(Post $post): void
            {
                // TODO: Implement save() method.
            }

            public function get(UUID $uuid): Post
            {
                throw new PostNotFoundException('Not found');
            }
        };
    }


    public function testItReturnErrorResponceIfNoUuid(): void
    {
        $request = new Request([], [], '');
        $postRepository = $this->postRepository([]);
        $action = new CreatePosts($postRepository);
        $responce = $action->handle($request);
        $this->assertInstanceOf(ErrorResponse::class, $responce);
        $this->expectOutputString('{"success":false,"reason":"No such query param in the request uuid"}');
        $responce->send();
    }


    public function testItReturnErrorResponceIfUUIDNotFound(): void
    {
        $uuid = UUID::random();
        $request = new Request(['uuid' => $uuid], [], '');
        $userRepository = $this->postRepository([]);
        $action = new CreatePosts($userRepository);
        $responce = $action->handle($request);
        $this->assertInstanceOf(ErrorResponse::class, $responce);
        $this->expectOutputString('{"success":false,"reason":"Not found"}');
        $responce->send();
    }

    /**
     * @throws \JsonException
     */
    public function testItReturnSuccessfulResponse(): void
    {
        $uuid = UUID::random();
        $request = new Request(['uuid' => "$uuid"], [], '');
        $postRepository = $this->postRepository([new Post($uuid, 'cd6a4d34-3d65-44a5-bb52-90a0ce3efcb3', 'tit', 'abcd')]);
        $action = new CreatePosts($postRepository);
        $responce = $action->handle($request);
        var_dump($responce);
        $this->assertInstanceOf(SuccessResponce::class, $responce);
        $this->expectOutputString('{"success":true,"data":{"uuid":"Peter"}}');
        $responce->send();
    }
}