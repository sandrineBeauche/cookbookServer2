<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\Unit as BaseUnit;


/**
 * Skeleton subclass for representing a row from the 'unit' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
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
