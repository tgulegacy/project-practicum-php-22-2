<?php

namespace Tgu\Polikarpov\Blog\Http\Actions;

use Tgu\Polikarpov\Blog\Http\Request;
use Tgu\Polikarpov\Blog\Http\Response;

interface ActionInterface
{
    public function handle(Request $request):Response;
}