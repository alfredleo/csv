<?php

namespace Neuffer\FileHandler;

class PlusAction extends AbstractAction
{
    protected $actionName = 'plus';

    public function isGood(int $a, int $b)
    {
        if($a < 0 && $b < 0) return false;
        if($a < 0 && (abs($a) > $b)) return false;
        if($b < 0 && (abs($b) > $a)) return false;
        return true;
    }

    public function result(int $a, int $b)
    {
        return $a + $b;
    }
}