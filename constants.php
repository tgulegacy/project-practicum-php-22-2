<?php
class MathOperations
{
    const PI = 3.14;
    public function returnPi() {
        echo self::PI . PHP_EOL;
    }

    public static function returnPiStatic() {
        echo self::PI . PHP_EOL;
    }
}

(new MathOperations())->returnPi();

MathOperations::returnPiStatic();
echo MathOperations::PI;