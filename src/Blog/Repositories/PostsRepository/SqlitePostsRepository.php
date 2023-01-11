<?php

namespace Tgu\Polikarpov\Blog\Repositories\PostsRepository;

use PDO;
use PDOStatement;
use Psr\Log\LoggerInterface;
use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\PostNotFoundException;

class SqlitePostsRepository implements PostsRepositoryInterface
{
    public function __construct(private PDO $connection,
                                private LoggerInterface $logger,)
    {

    }

    public function save(Post $post): void
    {
        $this->logger->info('Save post ');
        $statement = $this->connection->prepare(
            "INSERT INTO posts (uuid, uuid_author, title, text) VALUES (:uuid,:uuid_author,:title,:text)");
        $statement->execute([
            ':uuid' => (string)$post->getUuid(),
            ':uuid_author' => $post->getUuidUser(),
            ':title' => $post->getTitle(),
            ':text' => $post->getText()]);
        $this->logger->info("'Save post: $post" );
    }

    /**
     * @throws PostNotFoundException
     */
    private function getPost(PDOStatement $statement, string $value): Post
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new PostNotFoundException("Cannot get post: $value");
        }
        return new Post(new UUID($result['uuid']), $result['uuid_author'], $result['title'], $result['text']);
    }

    /**
     * @throws PostNotFoundException
     */
    public function get(UUID $uuid): Post
    {
        $statement = $this->connection->prepare(
            "SELECT * FROM posts WHERE uuid = :uuid"
        );
        $statement->execute([':uuid' => (string)$uuid]);
        return $this->getPost($statement, (string)$uuid);
    }

    /**
     * @throws PostNotFoundException
     */
    public function getTextPost(string $text): Post
    {
        $statement = $this->connection->prepare("SELECT * FROM posts WHERE text = :text");
        $statement->execute([':text' => (string)$text]);
        return $this->getPost($statement, $text);
    }
}