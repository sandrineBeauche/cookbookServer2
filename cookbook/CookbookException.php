<?php

namespace cookbook;

class CookbookException extends \Exception {
    
    
    protected $httpCode = 500;
    
    
    public function __construct($httpCode, $message){
        parent::__construct($message);
        $this->httpCode = $httpCode;
    }
    
    
    public function getHttpCode(){
        return $this->httpCode;
    }
} 
