<?php

namespace Tgu\Polikarpov\Blog\Commands;

use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;

class CreateUserCommand
{

    public function  __construct(
        private UsersRepositoryInterface $usersRepository
    )
    {
        
    }
    
    public function handle(Arguments $arguments):void
    {
        
    }
}