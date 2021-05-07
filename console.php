<?php
require_once __DIR__ . '/vendor/autoload.php';
use Neuffer\FileHandler\ActionLoader;

$logPathFile = 'log.csv';
$resultPathFile = 'result.csv';

$shortopts = "a:f:";
$longopts  = array(
    "action:",
    "file:",
);

$options = getopt($shortopts, $longopts);

if(isset($options['a'])) {
    $action = $options['a'];
} elseif(isset($options['action'])) {
    $action = $options['action'];
} else {
    $action = "xyz";
}

if(isset($options['f'])) {
    $file = $options['f'];
} elseif(isset($options['file'])) {
    $file = $options['file'];
} else {
    $file = "notexists.csv";
}


$actionLoader = new ActionLoader;
$actionLoader->getAction($action)
    ->setLogFilePath($logPathFile)
    ->setResultFilePath($resultPathFile)
    ->setSourceFilePath($file)
    ->execute();
