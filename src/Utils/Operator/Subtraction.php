<?php

namespace App\Utils\Operator;

class Subtraction extends AbstractOperator
{
	protected $sign = '-';
    protected int $priority = 1;

	public function process(int $first, int $second): int
    {
		return $first - $second;
	}

}
