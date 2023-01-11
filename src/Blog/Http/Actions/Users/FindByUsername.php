<?php

namespace Tgu\Polikarpov\Blog\Http\Actions\Users;

use Tgu\Polikarpov\Blog\Http\Actions\ActionInterface;
use Tgu\Polikarpov\Blog\Http\ErrorResponse;
use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;
use Tgu\Polikarpov\Blog\Http\SuccessResponse;
use Tgu\Polikarpov\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Polikarpov\Blog\Exceptions\HttpException;
use Tgu\Polikarpov\Blog\Exceptions\UserNotFoundException;

class FindByUsername implements ActionInterface
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $username = $request->query('username');
            $user =$this->usersRepository->getByUsername($username);
        }
        catch (HttpException | UserNotFoundException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        return new SuccessResponse(['username'=>$user->getUserName(),'name'=>$user->getName()->getFirstName().' '.$user->getName()->getLastName()]);
    }
}