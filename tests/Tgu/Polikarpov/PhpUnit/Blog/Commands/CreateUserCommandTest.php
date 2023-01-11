<?php

namespace Tgu\Polikarpov\PhpUnit\Blog\Commands;

use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Commands\Arguments;
use Tgu\Polikarpov\Blog\Commands\CreateUserCommand;
use Tgu\Polikarpov\Blog\Exceptions\ArgumentException;
use Tgu\Polikarpov\Blog\Exceptions\CommandException;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Person\Name;
use Tgu\Polikarpov\PhpUnit\Blog\DummyLogger;

class CreateUserCommandTest extends TestCase
{
    public function makeUsersRepository():UsersRepositoryInterface
    {
        return new class implements UsersRepositoryInterface
        {

            public function save(User $user): void
            {
                // TODO: Implement save() method.
            }

            public function getByUsername(string $username): User
            {
                return new User (UUID::random(), new Name('first','last'),'Ivan');
            }

            public function getByUuid(UUID $uuid): User
            {
                // TODO: Implement getByUuid() method.
            }
        };
            
    }
    /**
     * @throws ArgumentException
     */
    public function testItThrowsAnExceptionWhenUserAlreadyExist():void
    {
        $command = new CreateUserCommand(
            $this->makeUsersRepository(),
            new DummyLogger(),
        );
        $this->expectException(CommandException::class);
        $this->expectExceptionMessage('User already exist: Ivan');
        
        $command->handle(new Arguments(['username'=>'Ivan']));
    }
}
