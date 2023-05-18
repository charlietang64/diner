<?php

/*  328/diner/model/validation.php
    Contains functions to validate data
    in the diner app
    This is part of the MODEL
*/

function validMeal($meal)
{
    // If meal is not empty
    // and is in the array of
    // valid meals, return true
    // Otherwise, return false
    /*
    if (!empty($meal) && in_array($meal, getMeals())) {
        return true;
    }
    else {
        return false;
    }
    */
    return (!empty($meal) && in_array($meal, getMeals()));
    //return true;
}

function validFood($food)
{
    $food = trim($food);
    return (strlen($food) >= 2 && !ctype_digit($food));
}

function validCondiments($userCondiments) {
    $validCondiments = getCondiments();

    //Check each user condiment against array of valid condiments
    foreach($userCondiments as $userCondiment) {
        if(!in_array($userCondiment, $validCondiments)) {
            return false;
        }
    }
    return true;
}