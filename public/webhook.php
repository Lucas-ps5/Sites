<?php

require '../vendor/autoload.php';

use App\StripePayment;

//require_once 'buy.php';

/*$client_key = 'pk_test_51NhVxAE458DalFjJzBsYnaBuUiD3xkct8jgWFRB1AyvVGiBHF9yAnhDLnmL5iULXlbJhjHHezJ6PjfZgvkVJwDaE00MMdnzmaT';
$secret_key = 'sk_test_51NhVxAE458DalFjJkhmx0yWnP1IWVoem9GRRxERmnKCOT0vzeQMpDTNbbcVguDh8jpFOWDnHYkzjt7iSw7rvs7zG00ywwf8lGU';
$webhook_secret = 'whsec_8c978c99d72ee4eb7a8845bbfd7a8e51a06e5ab4fa98d4e721f8d3621d75de95';*/

$client_key = 'pk_test_51NhVxAE458DalFjJzBsYnaBuUiD3xkct8jgWFRB1AyvVGiBHF9yAnhDLnmL5iULXlbJhjHHezJ6PjfZgvkVJwDaE00MMdnzmaT';
$secret_key = 'sk_test_51NhVxAE458DalFjJkhmx0yWnP1IWVoem9GRRxERmnKCOT0vzeQMpDTNbbcVguDh8jpFOWDnHYkzjt7iSw7rvs7zG00ywwf8lGU';
$webhook_secret = 'whsec_8c978c99d72ee4eb7a8845bbfd7a8e51a06e5ab4fa98d4e721f8d3621d75de95';

$payment = new StripePayment($secret_key, $webhook_secret);
$payment->handle();