<?php

namespace App\Utils\Operator;

class Division extends AbstractOperator
{
	protected $sign = '/';
	protected int $priority = 2;

    public function getSign()
    {
        return $this->sign;
    }
}
