<?php

namespace Actor\Library;

class Division extends Action
{
    public $name = 'division';

    /**
     * get result of division
     * @param int $value1
     * @param int $value2
     * @return float
     */
    public function getResult(int $value1, int $value2): float
    {
        return $value2 / $value1;
    }
}