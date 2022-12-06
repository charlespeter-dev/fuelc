<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/how-to-determine-the-correct-sample-size-for-your-market-research-projects/';

$links = [
    'https://fuelcycle.com/blog/final-effective-steps-market-research/'    => 'sample size',
    'https://fuelcycle.com/blog/essential-steps-marketing-research-process/'    => 'sample size',
    'https://fuelcycle.com/blog/what-should-enterprises-look-for-in-their-market-research-solution/'    => 'sample size',
    'https://fuelcycle.com/blog/certainty-cost-trade-offs-machine-learning/'    => 'sample size',
    'https://fuelcycle.com/blog/testing-101-monadic-testing/'    => 'sample size',
    'https://fuelcycle.com/blog/when-is-an-online-community-best-for-you/'    => 'sample size',
];

$replace_counter = [
    'https://fuelcycle.com/blog/final-effective-steps-market-research/'    => 2,
    'https://fuelcycle.com/blog/essential-steps-marketing-research-process/'    => 1,
    'https://fuelcycle.com/blog/what-should-enterprises-look-for-in-their-market-research-solution/'    => 1,
    'https://fuelcycle.com/blog/certainty-cost-trade-offs-machine-learning/'    => 1,
    'https://fuelcycle.com/blog/testing-101-monadic-testing/'    => 1,
    'https://fuelcycle.com/blog/when-is-an-online-community-best-for-you/'    => 1,
];


require 'engine.php';
