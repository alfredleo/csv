<?php

namespace Neuffer\FileHandler;

class MinusAction extends AbstractAction
{
    protected $actionName = 'minus';

    public function isGood(int $a, int $b)
    {
        $result = $a - $b;
        return $result < 0;
    }

    public function result(int $a, int $b)
    {
        return $a - $b;
    }
}