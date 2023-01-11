<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
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

$conteiner->bind(
    LoggerInterface::class,
    (new Logger('blog'))->pushHandler(new StreamHandler(
        __DIR__.'/logs/blog.log',
    )) ->pushHandler(new StreamHandler(
        __DIR__.'/logs/blog.error.log',
        level: Logger::ERROR,
        bubble: false
    ))->pushHandler(new StreamHandler( "php://stdout"),
    ),
);
return $conteiner;