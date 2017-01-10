<?php

namespace cookbook;

class NotFoundException extends CookbookException {
    
    public function __construct($itemName, $itemId){
        parent::__construct(404, $itemName." with id ".$itemId." not found");
    }
} 