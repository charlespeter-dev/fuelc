<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/message-testing-guide/';

$links = [
    'https://fuelcycle.com/blog/market-research-product-experience/'    => 'Message testing',
    'https://fuelcycle.com/blog/marketing-mistakes/'    => 'message testing',
    'https://fuelcycle.com/blog/measuring-advertising-effectiveness-why-it-matters/'    => 'message testing',
    // 'https://fuelcycle.com/blog/market-research-digital-experiences/'    => 'Message testing',
    'https://fuelcycle.com/blog/how-to-use-a-focus-group-to-perform-market-research/'    => 'message testing',
];

$replace_counter = [
    'https://fuelcycle.com/blog/market-research-product-experience/'    => 1,
    'https://fuelcycle.com/blog/marketing-mistakes/'    => 1,
    'https://fuelcycle.com/blog/measuring-advertising-effectiveness-why-it-matters/'    => 1,
    // 'https://fuelcycle.com/blog/market-research-digital-experiences/'    => 1,
    'https://fuelcycle.com/blog/how-to-use-a-focus-group-to-perform-market-research/'    => 1,
];

require 'engine.php';
