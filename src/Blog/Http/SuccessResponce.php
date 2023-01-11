<?php

namespace Tgu\Polikarpov\Blog\Http;

class SuccessResponce extends Response
{
    protected const SUCCESS = true;

    public function __construct(
        public array $data=[]
    )
    {
    }
    function payload(): array
    {
        return ['data'=>$this->data];
    }

}