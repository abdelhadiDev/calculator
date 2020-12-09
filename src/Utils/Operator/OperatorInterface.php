<?php

namespace App\Utils\Operator;

interface OperatorInterface
{
    public function process(int $first, int $second): int;
    public function getSign();
    public function getPriority(): int;
}
