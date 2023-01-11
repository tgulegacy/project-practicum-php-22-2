<?php

use Tgu\Polikarpov\Blog\Commands\Arguments;
use Tgu\Polikarpov\Blog\Commands\CreateUserCommand;
use Tgu\Polikarpov\Blog\Exceptions\ArgumentException;
use Tgu\Polikarpov\Blog\Exceptions\CommandException;
use Tgu\Polikarpov\Blog\Likes;
use Tgu\Polikarpov\Blog\Repositories\CommentsRepository\SqliteCommentsRepository;
use Tgu\Polikarpov\Blog\Repositories\LikesRepository\SqliteLikeRepositories;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\InMemoryUsersRepository;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\SqliteUserRepository;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Person\Name;
use Tgu\Polikarpov\Blog\Comments;
use Tgu\Polikarpov\Blog\Repositories\PostsRepository\SqlitePostsRepository;
use Tgu\Polikarpov\Blog\Post;


//$conteiner = require __DIR__ .'/bootstrap.php';
//$command = $conteiner->get(CreateUserCommand::class);
//try{$command->handle(Arguments::fromArgv($argv));}
//catch (ArgumentException|CommandException $exception){echo 
//$exception->getMessage();}

require_once __DIR__ . '/vendor/autoload.php';

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

$likeRepository = new SqliteLikeRepositories($connection);

$likeRepository->saveLike(new Likes(UUID::random(),'71a9a1a5-caae-4bc4-9c29-ab7a91bcf002',
 '055c7d95-3d90-4458-9c87-ccea8a577f7b'));

//require_once __DIR__ . '/vendor/autoload.php';

//$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

//$userRepository = new SqliteUserRepository($connection);
//$userInMemoryRepository = new InMemoryUsersRepository();

//$userRepository->save(new User(UUID::random(),new Name('Ivan','Nikitin'),
// 'user1'));
//$userRepository->save(new User(UUID::random(),new Name('Peter1','Nikylin1'),
 //'admin1'));'

//echo $userRepository->getByUuid(new UUID
//('055c7d95-3d90-4458-9c87-ccea8a577f7b')) .
  //  PHP_EOL;
//echo $userRepository->getByUsername('admin') .
  //  PHP_EOL;

//$userInMemoryRepository->save(new User(UUID::random(),new Name('Peter',
// 'Nikylin'), 'admin'));
//$userInMemoryRepository->save(new User(UUID::random(),new Name('Peter1',
// 'Nikylin1'), 'admin1'));
//echo $userInMemoryRepository->getByUsername('admin') . PHP_EOL;

//$comRepository = new SqliteCommentsRepository($connection);

//$comRepository->save(new Comments(UUID::random(),
//'71a9a1a5-caae-4bc4-9c29-ab7a91bcf002', 'ec070a89-93f9-4176-bbed-da748ba77ae0','good'));
//echo $comRepository->get(new UUID('20f51116-d587-4485-b209-29631dbdaad1')) .
 // PHP_EOL;
//echo $comRepository->getTextComment('good') .
 //   PHP_EOL;


//$postRepository = new SqlitePostsRepository($connection);

//$postRepository->save(new Post(UUID::random(),
//'ec070a89-93f9-4176-bbed-da748ba77ae0', 'first','abc'));


//echo $postRepository->get(new UUID('71a9a1a5-caae-4bc4-9c29-ab7a91bcf002')) .
//  PHP_EOL;
//echo $postRepository->getTextPost('abc') .
 // PHP_EOL;





?>