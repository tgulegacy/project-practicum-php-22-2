<?php

namespace Tgu\Polikarpov\Blog\Commands;

class Arguments
{

    private array $arguments = [];
    
    public function __construct(
        iterable $arguments
    )
    {
        foreach ($arguments as $argument => $value){
            $strungValue = trim((string)$value);
            if (empty($strungValue)){
                continue;
            }
            $this->arguments[(string)$argument]=$strungValue;
        }
    }
    
    public static function fromArgv(array $argv): self
    {
        $arguments = [];
        foreach ($argv as $argument){
            $parts = explode('=', $argument);
            if(count($parts)!==2){
                continue;
            }
            $arguments[$parts[0]]=$parts[1];
        }
        return new self($arguments);
    }
    
}