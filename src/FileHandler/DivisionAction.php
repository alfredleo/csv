<?php

namespace Neuffer\FileHandler;

class DivisionAction extends AbstractAction
{
    protected $actionName = 'division';

    public function isGood(int $a, int $b)
    {
        if($b === 0) {
            return false;
        }
        $result = $a / $b;
        if($result < 0) {
            return false;
        }

        return true;
    }

    public function result(int $a, int $b)
    {
        return $a / $b;
    }
}