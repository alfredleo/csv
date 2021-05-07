<?php

namespace Neuffer\FileHandler;

class MultiplyAction extends AbstractAction
{
    protected $actionName = 'multiply';

    function isGood(int $a, int $b)
    {
        $result = $a - $b;
        return $result < 0;
    }

    function result(int $a, int $b)
    {
        return $a * $b;
    }
}