<?php

namespace Tgu\Polikarpov\PhpUnit\Blog\Commands;

use PHPUnit\Framework\TestCase;
use Tgu\Polikarpov\Blog\Commands\Arguments;
use Tgu\Polikarpov\Blog\Exceptions\ArgumentException;

class ArgumentsTest extends TestCase
{
    /**
     * @throws ArgumentException
     */
    public function testItReturnsArgumentsByName():void
    {
        //Arrange
        $arguments = new Arguments(['some_key' => 'some_value']);
        //Act
        $value = $arguments->get('some_key');
        //Assert
        $this->assertEquals( 'some_value', $value);
    }

    /**
     * @throws ArgumentException
     */
    public function testItReturnsValueAsString():void
    {
        //Arrange
        $arguments = new Arguments(['some_key' => 123]);
        //Act
        $value = $arguments->get('some_key');
        //Assert
        $this->assertEquals( '123', $value);
    }

    public function testItThrowAnExceptionWhenArgumentsAbsent():void
    {
        //Arrange
        $arguments = new Arguments([]);
        //Assert
        $this->expectException(ArgumentException::class);
        $this->expectExceptionMessage('No such argument: some_key');
        //Act
        $arguments->get('some_key');

    }
    
    public function argumentsProvider(): iterable
    {
        return[
            ['some_string', 'some_string'],
            [' some_string', 'some_string'],
            [123,'123'],
            [12.3,'12.3']
        ];
    }

    /**
     * @dataProvider argumentsProvider
     */
    
    public function testItConvertsArgumentsToString(
        $inputValue,
        $expectedValue
    ):void
    {
        //Arrange
        $arguments = new Arguments(['some_key' => $inputValue]);
        //Act
        $value = $arguments->get('some_key');
        //Assert
        $this->assertEquals( $expectedValue, $value);
    }

}