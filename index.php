<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tgu\Polikarpov\Blog\Post;
use Tgu\Polikarpov\Person\Name;
use Tgu\Polikarpov\Person\Person;

//автолоадер
//spl_autoload_register(function ($class)
//{
 //   $newClass=str_replace('_',DIRECTORY_SEPARATOR,$class);
//    $file = str_replace('\\',DIRECTORY_SEPARATOR,$newClass).'.php';
 
    
 //   if (file_exists($file)){
 //       require $file;
 //   }
//});



//$post = new Post(
//    new Person(
//        new Name('Иван','Иванов'),
//        new DateTimeImmutable()
//    ),
//    'Привет'
//);
//print $post;

function someFunction(bool $one, int $two=42,):string
{
    return $one . $two;
}

$reflection = new ReflectionFunction('someFunction');
echo $reflection->getReturnType()->getName()."\n";
foreach ($reflection->getParameters() as $parameter){
    echo $parameter->getName().'['.$parameter->getType()->getName()."]\n";
}