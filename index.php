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

require_once('vendor/autoload.php');

// create an F3 (Fat-Free Framework) object
$F3 = Base::instance();

// Define a default route
$F3->route('GET /', function () {
    // Display a view page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Define a breakfast route
$F3->route('GET /breakfast', function () {

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/breakfast.html');
});

// Define a lunch route
$F3->route('GET /lunch', function () {

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/lunch.html');
});

// Define a dinner route
$F3->route('GET /dinner', function () {

    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/dinner.html');
});

// Create a route "/order1" -> orderForm1.html
$F3->route('GET|POST /order1', function ($f3) {

    // If the form has been posted
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        // Get the data

        // Validate the data

        // Store the data in the session array

        // Redirect to order2 route
        $f3->reroute('order2');
    }

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

// Create a route "/order2" -> orderForm2.html
$F3->route('GET /order2', function () {

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

// Create a route "/summary" -> summary.html
$F3->route('GET /summary', function () {

    // Display a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$F3->run();
