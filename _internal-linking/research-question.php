<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/user-research-questions/';

$links = [
    'https://fuelcycle.com/blog/usability-research-how-to/'    => 'research questions',
    'https://fuelcycle.com/blog/qualitative-interviewing/'    => 'research questions',
    'https://fuelcycle.com/blog/are-these-5-things-disrupting-your-market-research-status-quo/'    => 'research questions',
    'https://fuelcycle.com/blog/qualitative-studies/'    => 'research question',
    'https://fuelcycle.com/blog/pilot-test-comparison/'    => 'research questions',
    'https://fuelcycle.com/blog/final-effective-steps-market-research/'    => 'research questions',
    'https://fuelcycle.com/blog/participant-observation-research/'    => 'research questions',
    'https://fuelcycle.com/blog/how-to-use-a-focus-group-to-perform-market-research/'    => 'research questions',
    'https://fuelcycle.com/blog/what-should-enterprises-look-for-in-their-market-research-solution/'    => 'research questions',
    'https://fuelcycle.com/blog/naturalistic-observation-research/'    => 'research question',
    'https://fuelcycle.com/blog/data-collection-methods-in-market-research/'    => 'research questions',
    'https://fuelcycle.com/blog/how-to-pilot-test/'    => 'research questions',
    'https://fuelcycle.com/blog/how-market-research-takes-gaas-to-the-next-level/'    => 'research questions',
];

$replace_counter = [
    'https://fuelcycle.com/blog/usability-research-how-to/'    => 1,
    'https://fuelcycle.com/blog/qualitative-interviewing/'    => 1,
    'https://fuelcycle.com/blog/are-these-5-things-disrupting-your-market-research-status-quo/'    => 1,
    'https://fuelcycle.com/blog/qualitative-studies/'    => 1,
    'https://fuelcycle.com/blog/pilot-test-comparison/'    => 1,
    'https://fuelcycle.com/blog/final-effective-steps-market-research/'    => 1,
    'https://fuelcycle.com/blog/participant-observation-research/'    => 1,
    'https://fuelcycle.com/blog/how-to-use-a-focus-group-to-perform-market-research/'    => 1,
    'https://fuelcycle.com/blog/what-should-enterprises-look-for-in-their-market-research-solution/'    => 1,
    'https://fuelcycle.com/blog/naturalistic-observation-research/'    => 1,
    'https://fuelcycle.com/blog/data-collection-methods-in-market-research/'    => 1,
    'https://fuelcycle.com/blog/how-to-pilot-test/'    => 1,
    'https://fuelcycle.com/blog/how-market-research-takes-gaas-to-the-next-level/'    => 1,
];

require 'engine.php';
