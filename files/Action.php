<?php
namespace Actor\Library;

abstract class Action
{
    public $name;

    /**
     * @param int $value1
     * @param int $value2
     * @return mixed
     * @throws \DivisionByZeroError
     */
    abstract function getResult(int $value1, int $value2);

}