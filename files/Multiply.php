<?php

namespace Actor\Library;

class Multiply extends Action
{
    public $name = 'multiply';

    /**
     * count result
     * @param int $value1
     * @param int $value2
     * @return int
     */
    public function getResult(int $value1, int $value2): int
    {
        return $value1 * $value2;
    }
}
