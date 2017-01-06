<?php

namespace cookbook;

trait AutoValidate {
    
    public function preSave(\Propel\Runtime\Connection\ConnectionInterface $con = null) {
        if($this->validate()){
            return true;
        }
        else{
            $failures = $this->getValidationFailures();
            throw new ValidationFailureException($failures);
        }
    }
}


trait CrudOperations {
    
    public static function create($params){
        $currentClass = self::class;
        $newItem = new $currentClass();
        $newItem->processParams($params);
        $newItem->save();
        return $newItem;
    }
    
    
    public function update($params){
        $this->processParams($params);
        $this->save();
    }
    
    public static function remove($id){
        $queryClass = self::class.'Query';
        $q = call_user_func(array($queryClass, 'create'));
        $item = $q->findPk($id);
        if(isset($item)){
           $item->delete(); 
        }
        else{
            throw new \cookbook\NotFoundException(self::class, $id);
        }
    }
}


trait RetrieveOrderedByName {
    
    public function retrieveAll(){
        $selectFields = self::$retrieveAllFields;
        $query = $this->select($selectFields)
                ->orderByName()
                ->find();
        $data = $query->getData();
        return $data;
    }
}

