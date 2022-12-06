<?php

require '../wp-load.php';

$dest = 'https://fuelcycle.com/blog/research-communities/';

$links = [
    'https://fuelcycle.com/blog/ux-research-with-communities/'    => 'Research communities',
    'https://fuelcycle.com/blog/how-community-can-help-your-enterprise/'    => 'Research communities',
    'https://fuelcycle.com/blog/communities-for-customer-centricity/'    => 'Online research communities',
    'https://fuelcycle.com/blog/stakeholder-engagement-strategy-how-to-keep-them-interested-in-research/'    => 'research communities',
    'https://fuelcycle.com/blog/2021-market-research-look-back/'    => 'research communities',
    'https://fuelcycle.com/blog/certainty-cost-trade-offs-machine-learning/'    => 'research communities',
    'https://fuelcycle.com/blog/development-predictive-analytics-market-research/'    => 'research communities',
    'https://fuelcycle.com/blog/future-of-financial-services-marketing/'    => 'research communities',
    'https://fuelcycle.com/blog/abercrombie-customer-story/'    => 'research communities',
    'https://fuelcycle.com/blog/fcc-2021-takeaways/'    => 'research communities',
];


$replace_counter = [
    'https://fuelcycle.com/blog/ux-research-with-communities/'    => 2,
    'https://fuelcycle.com/blog/how-community-can-help-your-enterprise/'    => 1,
    'https://fuelcycle.com/blog/communities-for-customer-centricity/'    => 1,
    'https://fuelcycle.com/blog/stakeholder-engagement-strategy-how-to-keep-them-interested-in-research/'    => 1,
    'https://fuelcycle.com/blog/2021-market-research-look-back/'    => 1,
    'https://fuelcycle.com/blog/certainty-cost-trade-offs-machine-learning/'    => 1,
    'https://fuelcycle.com/blog/development-predictive-analytics-market-research/'    => 1,
    'https://fuelcycle.com/blog/future-of-financial-services-marketing/'    => 1,
    'https://fuelcycle.com/blog/abercrombie-customer-story/'    => 1,
    'https://fuelcycle.com/blog/fcc-2021-takeaways/'    => 1,
];


require 'engine.php';
