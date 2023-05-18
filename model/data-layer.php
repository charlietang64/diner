<?php

/*  328/diner/model/data-layer.php
    Returns data for the diner app
    This is part of the MODEL
    Eventually, this will read/write the DB
*/

// Get the meals for the order1 form
function getMeals()
{
    $meals = array("breakfast", "lunch", "dinner");
    return $meals;
}

// Get the condiments for the order2 form
function getCondiments()
{
    $condiments = array("ketchup", "mustard", "mayo", "sriracha");
    return $condiments;
}