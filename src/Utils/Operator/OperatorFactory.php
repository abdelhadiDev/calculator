<?php

namespace App\Utils\Operator;

class OperatorFactory
{
    public static function create(string $sign): OperatorInterface
    {
        switch ($sign) {
            case '+':
                $operator = new Addition();
                break;
            case '-':
                $operator = new Subtraction();
                break;
            case '/':
                $operator = new Division();
                break;
            case '*':
                $operator = new Multiplication();
                break;
            default:
                throw new \Exception('Unknown operator');
        }

        return $operator;
    }
}
