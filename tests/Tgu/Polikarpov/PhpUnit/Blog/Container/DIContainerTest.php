<?php

namespace Tgu\Polikarpov\PhpUnit\Blog\Container;

use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Container\DIContainer;
use Tgu\Polikarpov\Blog\Exceptions\NotFoundException;
use Tgu\Polikarpov\Blog\User;

class DIContainerTest extends TestCase
{

    public function testItThrowAnExceptionIfCannotResolveType(): void
    {
        $container = new DIContainer();
        
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Cannot resolve type Tgu\Polikarpov\Blog\User');
        
        $container->get(User::class);
    }


}