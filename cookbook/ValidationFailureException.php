<?php

namespace cookbook;

class ValidationFailureException extends CookbookException {
    
    protected $messages = array();
    
    public function __construct($failures){
        parent::__construct(400, "erreurs de validation");
        foreach ($failures as $failure) {
            $colName = $failure->getPropertyPath();
            $message = $failure->getMessage();
            $this->messages[$colName] = $message;
        }
    }
    
    public function getErrors(){
        return $this->messages;
    }
} 

