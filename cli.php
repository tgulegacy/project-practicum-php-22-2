<?php

use Tgu\Polikarpov\Blog\Repositories\UserRepository\InMemoryUsersRepository;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\SqliteUserRepository;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Person\Name;

require_once __DIR__ . '/vendor/autoload.php';

$connection = new PDO('sqlite:' . __DIR__ . '/blog.sqlite');

$userRepository = new SqliteUserRepository($connection);
$userInMemoryRepository = new InMemoryUsersRepository();

//$userRepository->save(new User(UUID::random(),new Name('Ivan','Nikitin'),
// 'user1'));
//$userRepository->save(new User(UUID::random(),new Name('Peter','Nikylin'),
// 'admin'));

echo $userRepository->getByUuid(new UUID('055c7d95-3d90-4458-9c87-ccea8a577f7b')) .
    PHP_EOL;
echo $userRepository->getByUsername('admin') .
    PHP_EOL;

$userInMemoryRepository->save(new User(UUID::random(),new Name('Peter','Nikylin'),
 'admin'));
echo $userInMemoryRepository->getByUsername('admin') . PHP_EOL;
?>