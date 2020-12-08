<?php

declare(strict_types=1);

namespace App\Utils\Operator;

abstract class AbstractOperator implements OperatorInterface
{

	protected $sign = false;
	protected int $priority = 0;

	public function process(int $first, int $second): int {}

	public function getSign()
    {
		return $this->sign;
	}

	public function getPriority(): int
    {
		return $this->priority;
	}
}
