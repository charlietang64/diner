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