<?php

require_once 'Car.php';
require_once 'Wheel.php';

class CarTest extends \PHPUnit\Framework\TestCase
{
    public function testTurnShouldReturnRightWhenRightDirectionIsGiven()
    {
        $wheel = $this->getMockBuilder(Wheel::class)
            ->setMethods(['right'])
            ->getMock();

        $wheel->expects($this->once())
            ->method('right')
            ->will($this->returnValue('right'));

        $car = new Car();
        $car->setWheel($wheel);
        $result = $car->turn('right');
        $this->assertEquals('right', $result);
    }

    public function testTurnShouldReturnLeftWhenLeftDirectionIsGiven()
    {
        $wheel = $this->getMockBuilder(Wheel::class)
            ->setMethods(['left', 'right'])
            ->getMock();

        $wheel->expects($this->once())
            ->method('left')
            ->will($this->returnValue('left'));

        $wheel->expects($this->never())
            ->method('right');

        $car = new Car();
        $car->setWheel($wheel);
        $result = $car->turn('left');
        $this->assertEquals('left', $result);
    }
}
