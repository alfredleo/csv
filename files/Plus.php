<?php

namespace Actor\Library;

class Plus extends Action
{
    public $name = 'plus';

    /**
     * get addition result
     * @param int $value1
     * @param int $value2
     * @return int
     */
    public function getResult(int $value1, int $value2): int
    {
        return $value2 + $value1;
    }
}
