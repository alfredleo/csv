<?php

namespace Actor\Library;

use DivisionByZeroError;

class Division extends Action
{
    public $name = 'division';

    /**
     * get result of division
     * @param int $value1
     * @param int $value2
     * @return float
     * @throws DivisionByZeroError
     */
    public function getResult(int $value1, int $value2): float
    {
        if ($value2 == 0) throw new DivisionByZeroError();
        return $value1 / $value2;
    }
}