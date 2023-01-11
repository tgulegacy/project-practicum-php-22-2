<?php

namespace Tgu\Polikarpov\PhpUnit\Blog\Container;

use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Container\DIContainer;
use Tgu\Polikarpov\Blog\Exceptions\NotFoundException;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\InMemoryUsersRepository;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Polikarpov\Blog\User;

class DIContainerTest extends TestCase
{
    public function testItThrowAnExceptionResolveType():void
    {
        $container = new DIContainer();
        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('Cannot resolve type User');
        $container->get(User::class);
    }
    public function testItResolvesClassWithoutDependencies():void
    {
        $container = new DIContainer();
        $object = $container->get(SomeClassWithoutDependencies::class);
        $this->assertInstanceOf(SomeClassWithoutDependencies::class, $object);
    }
    public function testItResolvesClassByContract():void
    {
        $container = new DIContainer();
        $container->bind(UsersRepositoryInterface::class, InMemoryUserRepository::class);
        $object = $container->get(UsersRepositoryInterface::class);
        $this->assertInstanceOf(InMemoryUsersRepository::class, $object);
    }
    public function testItReturnsPredefinedObject():void
    {
        $container = new DIContainer();
        $container->bind(SomeClassWithParameter::class, new SomeClassWithParameter(43));
        $object = $container->get(SomeClassWithParameter::class);
        $this->assertInstanceOf(SomeClassWithParameter::class, $object);
        $this->assertSame(43, $object->geyValue());
    }
    public function testItResolvesClassWithDepending():void
    {
        $container = new DIContainer();
        $container->bind(SomeClassWithParameter::class, new SomeClassWithParameter(43));
        $object = $container->get(ComeClassDependingOnAnother::class);
        $this->assertInstanceOf(ComeClassDependingOnAnother::class, $object);
    }
}