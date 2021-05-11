<?php
namespace Actor\Library;

abstract class Action
{
    public $name;

    abstract function getResult(int $value1, int $value2);

}