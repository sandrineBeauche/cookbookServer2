<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\Unit as BaseUnit;


/**
 * Skeleton subclass for representing a row from the 'unit' table.
 *
 */
class Unit extends BaseUnit
{
    use \cookbook\AutoValidate, 
        \cookbook\CrudOperations;
    
   
    protected static $objectName = "unité";
    
    protected function processParams($params){
        $this->setName($params["name"]);
    }
    
}
