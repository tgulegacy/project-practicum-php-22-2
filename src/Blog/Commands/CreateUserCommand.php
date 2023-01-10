<?php

namespace Tgu\Polikarpov\Blog\Commands;

use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\CommandException;
use Tgu\Polikarpov\Blog\Exceptions\UserNotFoundException;
use Tgu\Polikarpov\Person\Name;

class CreateUserCommand
{

    public function  __construct(
        private UsersRepositoryInterface $usersRepository
    )
    {
        
    }
    
    public function handle(Arguments $arguments):void
    {
        $username = $arguments->get('username');
        if($this->userExist($username)){
            throw new CommandException("User already exist: $username");
        }
        $this->usersRepository->save(new User(UUID::random(), new Name($arguments->get('first_name'), $arguments->get('last_name')),$username));
    }
    public function userExist(string $username):bool{
        try{
            $this->usersRepository->getByUsername($username);
        }
        catch (UserNotFoundException $exception){
            return false;
        }
        return true;
    }
}