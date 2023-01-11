<?php

namespace Tgu\Polikarpov\Blog\Repositories\CommentsRepository;

use PDO;
use PDOStatement;
use Psr\Log\LoggerInterface;
use Tgu\Polikarpov\Blog\Comments;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\CommentNotFoundException;

class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    public function __construct(private PDO $connection,
                                private LoggerInterface $logger,)
    {

    }

    public function save(Comments $comment): void
    {
        $this->logger->info('Save comment ');
        $statement = $this->connection->prepare(
            "INSERT INTO comments (uuid, uuid_post, uuid_author, text) VALUES (:uuid,:uuid_post,:uuid_author, :text)");
        $statement->execute([
            ':uuid' => (string)$comment->getUuidComment(),
            ':uuid_post' => $comment->getUuidPost(),
            ':uuid_author' => $comment->getUuidUser(),
            ':text' => $comment->getTextComment()]);
        $this->logger->info("'Save comment: $comment" );
    }

    /**
     * @throws CommentNotFoundException
     */
    private function getComment(PDOStatement $statement, string $value): Comments
    {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result === false) {
            throw new CommentNotFoundException("Cannot get comment: $value");
        }
        return new Comments(new UUID($result['uuid']), $result['uuid_post'], $result['uuid_author'], $result['text']);
    }

    /**
     * @throws CommentNotFoundException
     */
    public function get(UUID $uuid): Comments
    {
        $statement = $this->connection->prepare(
            "SELECT * FROM comments WHERE uuid = :uuid");
        $statement->execute([':uuid' => (string)$uuid]);
        return $this->getComment($statement, (string)$uuid);
    }

    /**
     * @throws CommentNotFoundException
     */
    public function getTextComment(string $text): Comments
    {
        $statement = $this->connection->prepare("SELECT * FROM comments WHERE text = :text");
        $statement->execute([':text' => (string)$text]);
        return $this->getComment($statement, $text);
    }

}