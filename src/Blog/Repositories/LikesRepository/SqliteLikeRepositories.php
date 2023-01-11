<?php

namespace Tgu\Polikarpov\Blog\Repositories\LikesRepository;

use PDO;
use PDOStatement;
use Psr\Log\LoggerInterface;
use Tgu\Polikarpov\Blog\Likes;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\LikeNotFoundException;

class SqliteLikeRepositories implements LikesRepositoryInterface
{
    public function __construct(private PDO $connection,
                                private LoggerInterface $logger,)
    {

    }

    public function saveLike(Likes $likes):void{
        $this->logger->info('Save like ');
        $statement = $this->connection->prepare(
            "INSERT INTO likes (uuid, uuid_post, uuid_user) VALUES (:uuid,:uuid_post,:uuid_user)");
        $statement->execute([
            ':uuid'=>(string)$likes->getUuidLike(),
            ':uuid_post'=>$likes->getUuidPost(),
            ':uuid_user'=>$likes->getUuidUser()]);
        $this->logger->info("'Save like: $likes" );
    }


    /**
     * @throws LikeNotFoundException
     */
    private function getLike(PDOStatement $statement, string $value):Likes{
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result===false){
            throw new LikeNotFoundException("Cannot get like: $value");
        }
        return new Likes(new UUID($result['uuid']), $result['uuid_post'], $result['uuid_user']);
    }


    /**
     * @throws LikeNotFoundException
     */
    public function getByPostUuid(string $uuid_post): Likes
    {
        $statement = $this->connection->prepare(
            "SELECT * FROM likes WHERE uuid_post = :uuid_post"
        );
        $statement->execute([':uuid_post'=>$uuid_post]);
        return $this->getLike($statement, $uuid_post);
    }
}