<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/controlled-observation-research/';

$links = [
    'https://fuelcycle.com/blog/the-3-most-common-observation-research-methods/'    => 'controlled observations',
    'https://fuelcycle.com/blog/observation-research-methods/'    => 'Controlled observations',
    'https://fuelcycle.com/blog/participant-observation-research/'    => 'controlled observation research',
    'https://fuelcycle.com/blog/naturalistic-observation-research/'    => 'controlled observation',
];

$replace_counter = [
    'https://fuelcycle.com/blog/the-3-most-common-observation-research-methods/'    => 1,
    'https://fuelcycle.com/blog/observation-research-methods/'    => 1,
    'https://fuelcycle.com/blog/participant-observation-research/'    => 1,
    'https://fuelcycle.com/blog/naturalistic-observation-research/'    => 1,
];

require 'engine.php';
