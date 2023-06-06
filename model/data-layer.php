<?php

/*  328/diner/model/data-layer.php
    Returns data for the diner app
    This is part of the MODEL
    Eventually, this will read/write the DB
*/

require_once($_SERVER['DOCUMENT_ROOT'].'/../pdo-config.php');

class DataLayer
{
    /**
     * @var PDO The database connection object
     */
    private $_dbh;

    /**
     * DataLayer constructor
     */
    function __construct()
    {
        try {
            $this->_dbh = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
            // echo 'Connected to database!';
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /** saveOrder saves an order from the Diner
     * @param Order An order object
     * @return int The orderID for the new order
     */
    function saveOrder($order)
    {
        // Define the query
        $sql = "INSERT INTO orders (food, meal, condiments)
                VALUES (:food, :meal, :condiments)";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Bind the parameters
        $food = $order->getFood();
        $meal = $order->getMeal();
        $condiments = $order->getCondiments();

        $statement->bindParam(':food', $food);
        $statement->bindParam(':meal', $meal);
        $statement->bindParam(':condiments', $condiments);

        // Execute
        $statement->execute();

        // Return the primary key
        $id = $this->_dbh->lastInsertId();
        return $id;
    }

    function getOrders()
    {
        // Define the query
        $sql = "SELECT order_id, food, meal, condiments, date_time FROM `orders`;";

        // Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // Execute
        $statement->execute();

        // Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Get the meals for the order1 form
    static function getMeals()
    {
        $meals = array("breakfast", "lunch", "dinner");
        return $meals;
    }

    // Get the condiments for the order2 form
    static function getCondiments()
    {
        $condiments = array("ketchup", "mustard", "mayo", "sriracha");
        return $condiments;
    }
}