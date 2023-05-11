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
//var_dump(getMeals());

//if (validateMeal('gam')){
//    print ('valid');
//}
//else {
//    print ('Not Valid');
//}

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

$F3->route('GET /happy-hour', function () {
    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/happyHour.html');
});

$F3->route('GET /test', function () {
    // Display a view page
    $view = new Template();
    echo $view->render('views/menus/test.html');
});

// Create a route "/order1" -> orderForm1.html
$F3->route('GET|POST /order1', function ($f3) {

    $food="";
    $meal="";
    // If the form has been posted
    // "Auto-Global" Arrays: $_SERVER, $_GET, $_POST
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        // Get the data
        //var_dump($_POST);
        $food = $_POST['food'];
        $meal = $_POST['meal'];
        //echo("Food: $food, Meal: $meal");

        // Validate the data
        if (validateMeal($meal)) {
            $f3->set('SESSION.meal', $meal);
        }
        else {
            $f3->set('errors["meal"]', 'Invalid meal Selected');
        }

        // Store the data in the session array
        $f3->set('SESSION.food', $food);
        //$_SESSION['food'] = $food;

        // Redirect to order2 route

        if (empty($f3->get('errors'))) {
            $f3->reroute('order2');
        }
    }

    $f3->set('meals', getMeals());

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

// Create a route "/order2" -> orderForm2.html
$F3->route('GET|POST /order2', function ($f3) {

    if($_SERVER['REQUEST_METHOD'] == "POST") {

    // Get the data
    //var_dump($_POST);
    $conds = implode(", ",$_POST['conds']);
    //echo $conds;

    // Store the data in the session array
    $f3->set('SESSION.conds', $conds);

    // Redirect to the summary route
    $f3->reroute('summary');

    }

    $f3->set('condiments', getCondiments());

    // Display a view page
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

// Create a route "/summary" -> summary.html
$F3->route('GET /summary', function () {

    // Display a view page
    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});

// Run Fat-Free
$F3->run();
