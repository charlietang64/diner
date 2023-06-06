<?php

/*
 * Charlie Tang
 * 4/18/2023
 * 328/diner/index.php
 * Controller for diner project
 */

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the needed files
require_once('vendor/autoload.php');

// *** Testing Only ***
$dataLayer = new DataLayer();

//$orders = $dataLayer->getOrders();
//var_dump($orders);

// Create an F3 (Fat-Free Framework) object
$f3 = Base::instance();
$con = new Controller($f3);

// Base $f3 = new Base(); --> Java

// Define a default route
$f3->route('GET /', function() {

    $GLOBALS['con']->home();
});

// Define a breakfast route
$f3->route('GET /breakfast', function() {

    //echo '<h1>Breakfast Menu</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/bfast.html');
});

// Define a breakfast route
$f3->route('GET /happy-hour', function() {

    //echo '<h1>Breakfast Menu</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/happyHour.html');
});

// Create a route "/order1" -> orderForm1.html
$f3->route('GET|POST /order1', function() {

    $GLOBALS['con']->order1();
});

// Create a route "/order2" -> orderForm2.html
$f3->route('GET|POST /order2', function() {

    $GLOBALS['con']->order2();
});

// Create a route "/summary" -> summary.html
$f3->route('GET /summary', function() {

    $GLOBALS['con']->summary();
});

$f3->route('GET /admin', function() {

    $GLOBALS['con']->admin();
});

// Run Fat-Free
$f3->run();