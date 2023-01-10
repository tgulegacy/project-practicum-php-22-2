<?php

namespace Tgu\Polikarpov\Blog\Repositories\UserRepository;

use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\UserNotFoundException;

class InMemoryUsersRepository implements UsersRepositoryInterface
{
    private array $users = [];
    
    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    public function getByUsername(string $username): User
    {
        foreach ($this->users as $user){
            if((string)$user->getUsername()===$username){
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $username");
    }

    public function getByUuid(UUID $uuid): User
    {
        foreach ($this->users as $user){
            if((string)$user->getUsername()===(string)$uuid){
                return $user;
            }
        }
        throw new UserNotFoundException("User not found: $uuid");
    }
}