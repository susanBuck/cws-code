<?php

require 'vendor/autoload.php';

# Make the RandomQuotes class accessible within this file
use RandomQuotes\RandomQuotes;
use App\Demo;

print_r(Demo::test());

# Use the RandomQuotes class
$rq = new RandomQuotes();
$quote = $rq->generate();
print_r($quote);
