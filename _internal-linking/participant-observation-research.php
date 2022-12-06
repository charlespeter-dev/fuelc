<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/participant-observation-research/';

$links = [
    'https://fuelcycle.com/blog/the-3-most-common-observation-research-methods/'    => 'participant observations',
    'https://fuelcycle.com/blog/observation-research-methods/'    => 'Participant observation',
    'https://fuelcycle.com/blog/controlled-observation-research/'    => 'participant observation research',
    'https://fuelcycle.com/blog/naturalistic-observation-research/'    => 'participant observation research',
    'https://fuelcycle.com/blog/qualitative-studies/'    => 'Participant observation',
    'https://fuelcycle.com/blog/5-market-research-trends-2020/'    => 'participant observation',
];

$replace_counter = [
    'https://fuelcycle.com/blog/the-3-most-common-observation-research-methods/'    => 1,
    'https://fuelcycle.com/blog/observation-research-methods/'    => 2,
    'https://fuelcycle.com/blog/controlled-observation-research/'    => 1,
    'https://fuelcycle.com/blog/naturalistic-observation-research/'    => 1,
    'https://fuelcycle.com/blog/qualitative-studies/'    => 1,
    'https://fuelcycle.com/blog/5-market-research-trends-2020/'    => 1,
];

require 'engine.php';
