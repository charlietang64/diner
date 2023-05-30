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
$f3->route('GET|POST /order2', function($f3) {

    //Initialize condiments array
    $selectedCondiments = array();

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // If condiments have been selected
        if (!empty($_POST['conds'])) {

            // Get condiments
            $selectedCondiments = $_POST['conds'];

            // Validate condiments
            if (Validate::validCondiments($selectedCondiments)) {

                // Implode and add to order object in the session array
                $condString = implode(", ", $selectedCondiments);

                $f3->get('SESSION.order')->setCondiments($condString);
                //--- or ---
                //$newOrder = $f3->get('SESSION.order');
                //$newOrder->setCondiments($condString);
                //$f3->set('SESSION.order', $newOrder);
            }
            else {

                // Set error in F3 hive
                $f3->set('errors["conds"]', 'Go away, evildoer!');
            }
        }

        //Redirect to the summary route if there are no errors
        if (empty($f3->get('errors'))) {
            $f3->reroute('summary');
        }
    }

    // Get the data from the model and add to hive
    $f3->set('condiments', DataLayer::getCondiments());

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

// Create a route "/summary" -> summary.html
$f3->route('GET /summary', function() {

    //echo '<h1>Breakfast Menu</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

// Run Fat-Free
$f3->run();