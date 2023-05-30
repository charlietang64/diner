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
    private $_condiment;

    /**
     * Default constructor for Order
     */
    function __construct()
    {
        $this->_food = "";
        $this->_meal = "";
        $this->_condiment = "";
    }

    /**
     * Set food for order
     * @param string $food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * Set meal for order
     * @param string $meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * Set condiment for order
     * @param string $condiment
     */
    public function setCondiments($condiment)
    {
        $this->_condiment = $condiment;
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
     * Get meal for order
     * @return string
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * Get condiment for order
     * @return string
     */
    public function getCondiments()
    {
        return $this->_condiment;
    }
}

/*
$testOrder = new Order();
$testOrder->setFood("beans");
$testOrder->setMeal("brekky");
$testOrder->setCondiment("ketchup");
echo $testOrder->getFood();
echo "<br>";
echo $testOrder->getMeal();
echo "<br>";
echo $testOrder->getCondiment();
*/