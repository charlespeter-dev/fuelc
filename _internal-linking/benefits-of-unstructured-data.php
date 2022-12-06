<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/why-unstructured-data-collection-is-so-essential-to-businesses/';

$links = [
    'https://fuelcycle.com/blog/what-is-unstructured-data/'    => 'unstructured data',
];


$replace_counter = [
    'https://fuelcycle.com/blog/what-is-unstructured-data/'    => 2,
];

require 'engine.php';
