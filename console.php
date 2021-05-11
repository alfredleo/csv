<?php

use Actor\Library\Division;
use Actor\Library\Minus;
use Actor\Library\Multiply;
use Actor\Library\Plus;
use Actor\Library\Reader;

require 'vendor/autoload.php';


$shortOpts = "a:f:";
$longOpts = array(
    "action:",
    "file:",
);

$options = getopt($shortOpts, $longOpts);

if (isset($options['a'])) {
    $action = $options['a'];
} elseif (isset($options['action'])) {
    $action = $options['action'];
} else {
    $action = "xyz";
}

if (isset($options['f'])) {
    $file = $options['f'];
} elseif (isset($options['file'])) {
    $file = $options['file'];
} else {
    $file = "notexists.csv";
}

try {
    if ($action == "plus") {
        $reader = new Reader($file);
        $reader->execute(new Plus());
    } elseif ($action == "minus") {
        $reader = new Reader($file);
        $reader->execute(new Minus());
    } elseif ($action == "multiply") {
        $reader = new Reader($file);
        $reader->execute(new Multiply());
    } elseif ($action == "division") {
        $reader = new Reader($file);
        $reader->execute(new Division());
    } else {
        throw new Exception("Wrong action is selected");
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}