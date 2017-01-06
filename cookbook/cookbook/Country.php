<?php

namespace cookbook\cookbook;

use cookbook\cookbook\Base\Country as BaseCountry;

/**
 * Skeleton subclass for representing a row from the 'country' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
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
