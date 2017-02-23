<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\Country as BaseCountry;

/**
 * Skeleton subclass for representing a row from the 'country' table.
 *
 */
class Country extends BaseCountry
{
    use \cookbook\AutoValidate, 
        \cookbook\CrudOperations;
    
   
    protected static $objectName = "pays";
    
    protected function processParams($params){
        $this->setName($params["name"]);
        
        if(array_key_exists("flag", $params)){
            $this->setFlag($params["flag"]);
        }
    }
}
