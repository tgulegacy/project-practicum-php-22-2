<?php

namespace Tgu\Polikarpov\PhpUnit\Repositories\UsersRepository;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\SqliteUserRepository;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\InvalidArgumentException;
use Tgu\Polikarpov\Blog\Exceptions\UserNotFoundException;
use Tgu\Polikarpov\Person\Name;
use Tgu\Polikarpov\PhpUnit\Blog\DummyLogger;

class SqliteUsersRerositoryTest extends TestCase
{
    public function testItTrowsAnExceptionWhenUserNotFound():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUserRepository($connectionStub, new DummyLogger());

        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('Cannot get user: admin');

        $repository->getByUsername('admin');
    }

    public function testItSaveUserToDB():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createMock(PDOStatement::class);

        $statementStub
            ->expects($this->once())
            ->method('execute')
            ->with([
                ':first_name'=>'Peter',
                ':last_name'=>'Nikylin',
                ':uuid' =>'ec070a89-93f9-4176-bbed-da748ba77ae0',
                ':username'=>'admin'
            ]);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUserRepository($connectionStub, new DummyLogger());

        $repository->save(new User(
            new UUID('ec070a89-93f9-4176-bbed-da748ba77ae0'),
            new Name('Peter', 'Nikylin'), 'admin'
        ));
    }

    /**
     * @throws UserNotFoundException
     */
    public function testItUuidUser ():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUserRepository($connectionStub, new DummyLogger());
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('Cannot get user: ec070a89-93f9-4176-bbed-da748ba77ae0');

        $repository->getByUuid(new UUID('ec070a89-93f9-4176-bbed-da748ba77ae0'));
    }

}
