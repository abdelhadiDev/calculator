<?php


namespace App\Tests\Utils;


use App\Utils\Calculator;
use App\Utils\CalculatorInterface;
use App\Utils\Operator\Addition;
use App\Utils\Operator\Division;
use App\Utils\Operator\Multiplication;
use App\Utils\Operator\Subtraction;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new Calculator();
        $input = '4 + 5 * 50';
        $result = $calculator->calculate($input);

        $this->assertEquals(254, $result);
        $this->assertIsInt($result);
        $this->assertIsNotString($result);

        $maxPriorityOfOperator = $calculator->getMaxPriority();
        $this->assertIsInt($maxPriorityOfOperator);

        $operatorPriority = $calculator->getPriorityOperator($maxPriorityOfOperator);
        $multiplication = $operatorPriority['*'];
        $this->assertIsArray($operatorPriority);
        $this->assertInstanceOf(Multiplication::class, $multiplication);
        $this->assertEquals($multiplication->getPriority(), 2);
        $this->assertEquals($multiplication->getSign(), '*');
    }

    public function testAddition()
    {
        $addition = new Addition();
        $result = $addition->process(7, 4);
        $this->assertEquals(11, $result);
    }

    public function testMultiplication()
    {
        $multiplication = new Multiplication();
        $result = $multiplication->process(3, 2);
        $this->assertEquals(6, $result);
    }

    public function testSubstraction()
    {
        $subtraction = new Subtraction();
        $result = $subtraction->process(5, 2);
        $this->assertEquals(3, $result);
    }

    public function testDivision()
    {
        $division = new Division();
        $result = $division->process(10, 2);
        $this->assertEquals(5, $result);
    }
}