<?php

require 'vendor/autoload.php';

use FizzBuzz\FizzBuzz;

// http://localhost:8888/?count=1000
$count = isset($_GET['count'])
    ? $_GET['count']
    : 15;

$FizzBuzz = new FizzBuzz;

echo implode(', ', $FizzBuzz->translateUpTo($count));
