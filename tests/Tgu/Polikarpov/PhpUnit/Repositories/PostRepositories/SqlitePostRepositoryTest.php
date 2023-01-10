<?php

namespace Tgu\Polikarpov\PhpUnit\Repositories\PostRepositories;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\Exceptions\PostNotFoundException;
use Tgu\Polikarpov\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\CommentNotFoundException;

class SqlitePostRepositoryTest extends TestCase
{
    public function testItTrowsAnExceptionWhenPostNotFound():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionStub);

        $this->expectException(PostNotFoundException::class);
        $this->expectExceptionMessage('Cannot get post: vaaaay');

        $repository->getTextPost('vaaaay');
    }

    public function testItSavePostToDB():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createMock(PDOStatement::class);

        $statementStub
            ->expects($this->once())
            ->method('execute')
            ->with([
                ':uuid' =>'71a9a1a5-caae-4bc4-9c29-ab7a91bcf002',
                ':uuid_author'=>'ec070a89-93f9-4176-bbed-da748ba77ae0',
                ':title'=>'first',
                ':text'=>'abc']);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionStub);

        $repository->save(new Post(
            new UUID('71a9a1a5-caae-4bc4-9c29-ab7a91bcf002'), 'ec070a89-93f9-4176-bbed-da748ba77ae0','first','abc'
        ));
    }

    public function testItUUidPosts():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionStub);

        $this->expectException(PostNotFoundException::class);


        $repository->get(new UUID('71a9a1a5-caae-4bc4-9c29-ab7a91bcf002'));
    }
}