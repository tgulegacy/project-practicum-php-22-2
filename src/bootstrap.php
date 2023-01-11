<?php

use Tgu\Polikarpov\Blog\Container\DIContainer;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\SqliteUserRepository;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;

require_once  __DIR__ . '/vendor/autoload.php';
$conteiner = new DIContainer();
$conteiner->bind(
    PDO::class,
    new PDO('sqlite:'.__DIR__.'/blog.sqlite')
);
$conteiner->bind(
    UsersRepositoryInterface::class,
    SqliteUserRepository::class
);
return $conteiner;