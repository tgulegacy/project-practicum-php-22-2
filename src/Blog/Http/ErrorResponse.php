<?php

namespace Tgu\Polikarpov\Blog\Http;

class ErrorResponse extends Response
{
    protected const SUCCESS = false;

    public function __construct(
        private string $reason = 'Something goes wrong'
    )
    {
    }

    function payload(): array
    {
        return ['reason' => $this->reason];
    }
}