<?php

namespace Tgu\Polikarpov\PhpUnit\Repositories\CommentsRepositories;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Comments;
use Tgu\Polikarpov\Blog\Exceptions\CommentNotFoundException;
use Tgu\Polikarpov\Blog\Repositories\CommentsRepository\SqliteCommentsRepository;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\SqliteUserRepository;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\InvalidArgumentException;
use Tgu\Polikarpov\Blog\Exceptions\UserNotFoundException;
use Tgu\Polikarpov\Person\Name;
use Tgu\Polikarpov\PhpUnit\Blog\DummyLogger;

class SqliteCommentsRepositoryTest extends TestCase
{
    public function testItTrowsAnExceptionWhenCommentNotFound():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteCommentsRepository($connectionStub, new DummyLogger());

        $this->expectException(CommentNotFoundException::class);
        $this->expectExceptionMessage('Cannot get comment: Qooooo');

        $repository->getTextComment('Qooooo');
    }

    public function testItSaveCommentsToDB():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createMock(PDOStatement::class);

        $statementStub
            ->expects($this->once())
            ->method('execute')
            ->with([
                ':uuid' =>'20f51116-d587-4485-b209-29631dbdaad1',
                ':uuid_post'=>'71a9a1a5-caae-4bc4-9c29-ab7a91bcf002',
                ':uuid_author'=>'ec070a89-93f9-4176-bbed-da748ba77ae0',
                ':text'=>'good'
            ]);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteCommentsRepository($connectionStub, new DummyLogger());

        $repository->save( new Comments(
            new UUID('20f51116-d587-4485-b209-29631dbdaad1'), '71a9a1a5-caae-4bc4-9c29-ab7a91bcf002','ec070a89-93f9-4176-bbed-da748ba77ae0','good'
        ));
    }

    public function testItUUidComments():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);


        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteCommentsRepository($connectionStub, new DummyLogger());

        $this->expectException(CommentNotFoundException::class);

        $repository->get(new UUID('20f51116-d587-4485-b209-29631dbdaad1'));
    }
}