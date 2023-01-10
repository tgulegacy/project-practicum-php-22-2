<?php

namespace Tgu\Polikarpov\PhpUnit\Blog\Http\Actions\Users;

use JsonException;
use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Http\Actions\Users\FindByUsername;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\UserNotFoundException;
use Tgu\Polikarpov\Person\Name;

class FindByUsernameActionTest extends TestCase
{
    private function userRepository(array $users): UsersRepositoryInterface
    {
        return new class($users) implements UsersRepositoryInterface {
            public function __construct(
                private array $users
            )
            {
            }

            public function save(User $user): void
            {
                // TODO: Implement save() method.
            }

            public function getByUsername(string $username): User
            {
                foreach ($this->users as $user) {
                    if ($user instanceof User && $username === $user->getUserName()) {
                        return $user;
                    }
                }
                throw new UserNotFoundException('Not found');
            }

            public function getByUuid(UUID $uuid): User
            {
                throw new UserNotFoundException('Not found');
            }
        };
    }


    /**
     * @runInSeparateProcess 
     * @preserveGlobalState disable
     * @throws JsonException
     */
    public function testItReturnErrorResponceIdNoUsernameProvided(): void
    {
        $request = new Request([], [], '');
        $userRepository = $this->userRepository([]);
        $action = new FindByUsername($userRepository);
        $responce = $action->handle($request);
        $this->assertInstanceOf(ErrorResponse::class, $responce);
        $this->expectOutputString('{"success":false,"reason":"No such query param in the request username"}');
        $responce->send();
    }


    /**
     * @runInSeparateProcess
     * @preserveGlobalState disable
     * @throws JsonException
     */
    public function testItReturnErrorResponceIdUserNotFound(): void
    {
        $request = new Request(['username' => 'Ivan'], [], '');
        $userRepository = $this->userRepository([]);
        $action = new FindByUsername($userRepository);
        $responce = $action->handle($request);
        $this->assertInstanceOf(ErrorResponse::class, $responce);
        $this->expectOutputString('{"success":false,"reason":"Not found"}');
        $responce->send();
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disable
     * @throws JsonException
     */
    public function testItReturnSuccessfulResponse(): void
    {
        $request = new Request(['username' => 'ivan'], [], '');
        $userRepository = $this->userRepository([new User(UUID::random(), new Name('Ivan', 'Nikitin'), 'user1')]);
        $action = new FindByUsername($userRepository);
        $responce = $action->handle($request);
        $this->assertInstanceOf(SuccessResponce::class, $responce);
        $this->expectOutputString('{"success":true,"data":{"username":"user1","name":"Ivan Nikitin"}}');
        $responce->send();
        
    }
}
