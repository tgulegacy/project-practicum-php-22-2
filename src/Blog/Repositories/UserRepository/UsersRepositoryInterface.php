<?php

namespace Tgu\Polikarpov\Blog\Repositories\UserRepository;

use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;

interface UsersRepositoryInterface
{
    public function save(User $user): void;
    public function getByUsername(string $username): User;
    public function getByUuid(UUID $uuid): User;
}