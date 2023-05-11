<?php
/* diner/model/validation.php
    Validates data from the diner
*/

function validateMeal($meal)
{
    // If meal is not empty and is
    // in the array of valid meals
    //return true otherwise return false
    if (!empty($meal) && in_array($meal, getMeals())) {
        return true;
    }
    else {
        return false;
    }
}