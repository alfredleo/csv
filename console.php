<?php

$shortopts = "a:f:";
$longopts = array(
    "action:",
    "file:",
);

$options = getopt($shortopts, $longopts);

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
        include 'files/Plus.php';
        $classOne = new Plus($file);
    } elseif ($action == "minus") {
        include 'files/Minus.php';
        $classTwo = new Minus($file, "minus");
        $classTwo->start();
    } elseif ($action == "multiply") {
        include 'files/Multiply.php';
        $classThree = new Multiply();
        $classThree->setFile($file);
        $classThree->execute();
    } elseif ($action == "division") {
        include 'files/Division.php';
        $classFour = new Division($file);
    } else {
        throw new Exception("Wrong action is selected");
    }
} catch (Exception $exception) {
    echo $exception->getMessage();
}