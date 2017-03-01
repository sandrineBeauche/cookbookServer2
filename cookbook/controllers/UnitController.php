<?php
/**
 * The controller that exposes Unit data.
 */

namespace cookbook\controllers;


/**
 * The controller that exposes Unit data.
 */
class UnitController {
    
    use GetAllOrderedByNameAction,
        CreateAction,
        DeleteAction;
}