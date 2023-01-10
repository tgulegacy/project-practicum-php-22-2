<?php

namespace Tgu\Polikarpov\Blog\Http\Actions\Users;

use Tgu\Polikarpov\Blog\Http\Actions\ActionInterface;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;
use Tgu\Polikarpov\Blog\Http\SuccessResponce;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Polikarpov\Blog\User;
use Tgu\Polikarpov\Blog\UUID;
use Tgu\Polikarpov\Blog\Exceptions\HttpException;

class CreateUser implements ActionInterface
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $newUserUuid = UUID::random();
            $user = new User($newUserUuid, new Name($request->jsonBodyField
            ('first_name'), $request->jsonBodyField('last_name')), $request->jsonBodyField('username'));
        } catch (HttpException $exception) {
            return new ErrorResponse($exception->getMessage());
        }
        $this->usersRepository->save($user);
        return new SuccessResponce(['uuid' => (string)$newUserUuid]);
    }

}