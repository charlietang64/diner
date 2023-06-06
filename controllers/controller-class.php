<?php

class Controller
{
    //F3 object
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //echo '<h1>Testing!</h1>';

        // Display a view page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    function order1()
    {
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
            $newOrder = new Order();

            // If meal is valid, add it to the SESSION
            if (Validate::validMeal($meal)) {

                //Set the meal in the order object
                $newOrder->setMeal($meal);
            }
            // Meal is not valid -> set an error variable
            else {
                $this->_f3->set('errors["meal"]', 'Invalid meal selected');
            }

            // *** If food is valid, add it to the SESSION
            if (Validate::validFood($food)) {

                //Set the food in the order object
                $newOrder->setFood($food);
            }
            // Meal is not valid -> set an error variable
            else {
                $this->_f3->set('errors["food"]', 'Invalid food entered');
            }

            // Redirect to order2 route if there
            // are no errors (errors array is empty)
            if (empty($this->_f3->get('errors'))) {

                //Add order object to session
                $this->_f3->set('SESSION.order', $newOrder);
                //var_dump($f3->get('SESSION.order'));
                $this->_f3->reroute('order2');
            }
        }

        // Get the data from the model and add to hive
        $this->_f3->set('meals', DataLayer::getMeals());

        // Add user data to the hive
        $this->_f3->set('userFood', $food);
        $this->_f3->set('userMeal', $meal);

        // Display a view page
        $view = new Template();
        echo $view->render('views/orderForm1.html');
    } // end order1 method

    function order2()
    {
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

                    $this->_f3->get('SESSION.order')->setCondiments($condString);
                    //--- or ---
                    //$newOrder = $f3->get('SESSION.order');
                    //$newOrder->setCondiments($condString);
                    //$f3->set('SESSION.order', $newOrder);
                }
                else {

                    // Set error in F3 hive
                    $this->_f3->set('errors["conds"]', 'Go away, evildoer!');
                }
            }

            //Redirect to the summary route if there are no errors
            if (empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('summary');
            }
        }

        // Get the data from the model and add to hive
        $this->_f3->set('condiments', DataLayer::getCondiments());

        // Display a view page
        $view = new Template();
        echo $view->render('views/orderForm2.html');
    } // end order2 method

    function summary()
    {
        //echo '<h1>Breakfast Menu</h1>';

        // Save order to DB
        $orderID = $GLOBALS['dataLayer']->saveOrder($this->_f3->get('SESSION.order'));
        // echo ("Order ID: $orderID");
        $this->_f3->set('orderId', $orderID);

        // Display a view page
        $view = new Template();
        echo $view->render('views/summary.html');

        session_destroy();
    }

    function admin()
    {
        $orders = $GLOBALS['dataLayer']->getOrders();
        //var_dump($orders);
        $this->_f3->set('orders', $orders);

        $view = new Template();
        echo $view->render('views/admin.html');
    }
} // end class
