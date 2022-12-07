<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/what-is-ux-research-why-is-it-important/';

$links = [
    // 'https://fuelcycle.com/blog/improve-ux-research/'    => 'UX research',
    // 'https://fuelcycle.com/blog/5-ux-research-tools-strategies-for-2022/'    => 'UX research',
    // 'https://fuelcycle.com/blog/market-vs-ux-research/'    => 'UX research',
    // 'https://fuelcycle.com/blog/5-signs-ux-research-is-more-important-than-ever/'    => 'UX research',
    // 'https://fuelcycle.com/blog/ux-research-with-communities/'    => 'UX research',
    // 'https://fuelcycle.com/blog/user-research-questions/'    => 'UX research',
    // 'https://fuelcycle.com/blog/mobile-ux-research-redefined/'    => 'UX research',
    'https://fuelcycle.com/blog/the-podcast-episode-for-ux-researchers/' =>    'UX research',
    // 'https://fuelcycle.com/blog/ignition-system-usability-testing/' =>    'UX research',
    // 'https://fuelcycle.com/blog/market-research-digital-experiences/' =>    'UX research',
    // 'https://fuelcycle.com/blog/product-experience-research/'    => 'UX Research',
    // 'https://fuelcycle.com/blog/fc-connect-top-themes/'    => 'UX research',
    // 'https://fuelcycle.com/blog/4-benefits-of-agile-marketing/'    => 'UX research',
];

$replace_counter = [
    // 'https://fuelcycle.com/blog/improve-ux-research/'    => 4,
    // 'https://fuelcycle.com/blog/5-ux-research-tools-strategies-for-2022/'    => 2,
    // 'https://fuelcycle.com/blog/market-vs-ux-research/'    => 2,
    // 'https://fuelcycle.com/blog/5-signs-ux-research-is-more-important-than-ever/'    => 2,
    // 'https://fuelcycle.com/blog/ux-research-with-communities/'    => 2,
    // 'https://fuelcycle.com/blog/user-research-questions/'    => 1,
    // 'https://fuelcycle.com/blog/mobile-ux-research-redefined/'    => 2,
    'https://fuelcycle.com/blog/the-podcast-episode-for-ux-researchers/' =>    3,
    // 'https://fuelcycle.com/blog/ignition-system-usability-testing/' =>    2,
    // 'https://fuelcycle.com/blog/market-research-digital-experiences/' =>    1,
    // 'https://fuelcycle.com/blog/product-experience-research/'    => 2,
    // 'https://fuelcycle.com/blog/fc-connect-top-themes/'    => 2,
    // 'https://fuelcycle.com/blog/4-benefits-of-agile-marketing/'    => 1,
];

require 'engine.php';
