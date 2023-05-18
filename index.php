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
require_once('model/data-layer.php');
require_once('model/validation.php');

//Test validation functions
/*
if (validMeal('elevensies')){
    print ('valid');
}
else {
    print ('not valid');
}
*/
//var_dump(getCondiments());

// Create an F3 (Fat-Free Framework) object
$f3 = Base::instance();
// Base $f3 = new Base(); --> Java

// Define a default route
$f3->route('GET /', function() {

    //echo '<h1>Welcome to My Diner!</h1>';

    // Display a view page
    $view = new Template();
    echo $view->render('views/home.html');
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
$f3->route('GET|POST /order1', function($f3) {

    //Initialize variables
    $food = "";
    $meal = "";

    // If the form has been posted
    // "Auto-global" arrays:  $_SERVER, $_GET, $_POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get the data from the POST array
        // ["food"]=>"ramen" ["meal"]=>"lunch"
        var_dump($_POST);
        if (isset($_POST['food'])) {
            $food = $_POST['food'];
        }
        if (isset($_POST['meal'])) {
            $meal = $_POST['meal'];
        }

        //echo ("Food: $food, Meal: $meal");

        // If meal is valid, add it to the SESSION
        if (validMeal($meal)) {
            $f3->set('SESSION.meal', $meal);
        }
        // Meal is not valid -> set an error variable
        else {
            $f3->set('errors["meal"]', 'Invalid meal selected');
        }

        // *** If food is valid, add it to the SESSION
        if (validFood($food)) {
            $f3->set('SESSION.food', $food);
        }
        // Meal is not valid -> set an error variable
        else {
            $f3->set('errors["food"]', 'Invalid food entered');
        }

        // Redirect to order2 route if there
        // are no errors (errors array is empty)
        if (empty($f3->get('errors'))) {
            $f3->reroute('order2');
        }
    }

    // Get the data from the model and add to hive
    $f3->set('meals', getMeals());

    $f3->set('userFood', $food);
    $f3->set('userMeal', $meal);

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm1.html');
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
            if (validCondiments($selectedCondiments)) {

                // Implode and add to session array

                $f3->set('SESSION.condiments', implode(", ", $selectedCondiments));
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
    $f3->set('condiments', getCondiments());

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