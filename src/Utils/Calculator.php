<?php

declare(strict_types=1);

namespace App\Utils;

use App\Utils\Operator\OperatorFactory;

class Calculator implements CalculatorInterface
{
    protected array $operators = [];
    protected array $expressions = [];

    public function calculate(string $input): int
    {
        $this->expressions = preg_split('((\d+|\+|-|\*)|\s+)', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $this->initiateOperators($input);

        $priority = $this->getMaxPriority();
        for($i = $priority; $i >= 0; $i--) {
            $priorityOperator = $this->getPriorityOperator($i);
            $this->calculateOperators($priorityOperator);
        }

        return $this->expressions[0];
    }

    protected function initiateOperators(string $input): void
    {
        preg_match_all('~-?[()*/+-]~', $input, $matches, PREG_SET_ORDER, 0);
        foreach ($matches as $val) {
            $operator = OperatorFactory::create($val[0]);
            $this->operators[$operator->getSign()] = $operator;
        }
    }

    public function getMaxPriority(): int
    {
        $priority = 0;
        foreach($this->operators as $operator)
        {
            if($operator->getPriority() > $priority) {
                $priority = $operator->getPriority();
            }
        }

        return $priority;
    }

    public function getPriorityOperator(int $priority): array
    {
        $operators = array();
        foreach($this->operators as $operator) {
            if($operator->getPriority() == $priority) {
                $operators[$operator->getSign()] = $operator;
            }
        }

        return $operators;
    }

    protected function calculateOperators(array $operators): void
    {
        foreach($this->expressions as $index => &$part)
        {
            if(!array_key_exists($part, $operators) ) {
                continue;
            }

            $operator = $operators[$part];
            $firstNumber = $this->expressions[$index-1];
            $secondNumber = $this->expressions[$index+1];

            $sum = $operator->process(intval($firstNumber), intval($secondNumber));
            $this->replaceExpressionWithSum($index, $sum);
        }
    }

    protected function replaceExpressionWithSum(int $index, int $sum): void
    {
        $this->expressions[$index-1] = null;
        $this->expressions[$index+1] = null;
        $this->expressions[$index] = $sum;

        $this->expressions = array_values(array_filter($this->expressions));
    }

    public function getOperators(): array
    {
        return $this->operators;
    }
}