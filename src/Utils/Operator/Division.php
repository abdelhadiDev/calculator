<?php

namespace App\Utils\Operator;

class Division extends AbstractOperator
{
	protected $sign = '/';
	protected int $priority = 2;

	public function process(int $first, int $second): int
    {
		return $first / $second;
	}
}
