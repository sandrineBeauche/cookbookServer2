<?php

/**
 * The controller that exposes Country data.
 */

namespace cookbook\controllers;


/**
 * The controller that exposes Country data.
 */
class CountryController {
    
    use GetAllOrderedByNameAction,
        CreateAction,
        UpdateAction,
        DeleteAction;
}

