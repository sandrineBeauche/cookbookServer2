<?php

namespace cookbook;

class NotFoundException extends CookbookException {
    
    public function __construct(String $itemName, int $itemId){
        parent::__construct(404, $itemName." with id ".$itemId." not found");
    }
} 