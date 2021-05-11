<?php

namespace Actor\Library;

class Minus extends Action
{
    public $name = 'minus';

    /**
     * get result of subtraction
     * @param int $value1
     * @param int $value2
     * @return int
     */
    public function getResult(int $value1, int $value2): int
    {
        return $value1 - $value2;
    }
}
