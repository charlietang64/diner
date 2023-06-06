<?php
/**
 * The Order class represents a customer
 * order from My Diner
 * @author Charlie Tang
 * @date May 23, 2023
 * @version 1.1
 */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    //Add two more variables:
    //meal and condiments
    //Initialize in constructor
    //Create setters and getters
    //Test methods

    /**
     * Default constructor for Order
     */
    function __construct($food = "", $meal = "", $condiments = "")
    {
        $this->_food = $food;
        $this->_meal = $meal;
        $this->_condiments = $condiments;
    }

    /**
     * Set food for order
     * @param string $food
     */
    public function setFood (string $food)
    {
        $this->_food = $food;
    }

    /**
     * Get food for order
     * @return string
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * Set meal for order
     * @param string $meal
     */
    public function setMeal(string $meal)
    {
        $this->_meal = $meal;
    }

    /**
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * Set condiments for order
     * @param string $condiments
     */
    public function setCondiments(string $condiments)
    {
        $this->_condiments = $condiments;
    }

    /**
     * Get condiments for order
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    //Useless method for demo purposes only!
    public static function sayHello()
    {
        echo "Hello";
    }
}

/*
//Test code
$order = new Order();

$order->setFood("pancakes");
$order->setMeal("breakfast");
$order->setCondiments("ketchup");

echo $order->getFood();
echo $order->getMeal();
echo $order->getCondiments();
echo "<pre>";
var_dump($order);
echo "</pre>";
*/