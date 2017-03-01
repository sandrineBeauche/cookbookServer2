<?php
/**
 * Custom behaviors for data model objects
 */
namespace cookbook;

/**
 * Behavior that allows data model objects to check validation before saving.
 */
trait AutoValidate {
    
    /**
     * 
     * @param \Propel\Runtime\Connection\ConnectionInterface $con the propel connection used to perform the pre-save operations.
     * @return boolean true if the object if validated, false otherwise
     * @throws ValidationFailureException if a validation error occurs.
     */
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


/**
 * Behaviour that provides convenients ways to perform crud operations.
 */
trait CrudOperations {
    
    /**
     * Performs the creation CRUD operation.
     * @param type $params the data used to create the model.
     * @return \cookbook\currentClass a new instance of a data model object.
     */
    public static function create($params){
        $currentClass = self::class;
        $newItem = new $currentClass();
        $newItem->processParams($params);
        $newItem->save();
        return $newItem;
    }
    
    
    /**
     * Performs the update CRUD operation.
     * @param type $params the new data of the object.
     */
    public static function update($id, $params){
        $queryClass = self::class.'Query';
        $q = call_user_func(array($queryClass, 'create'));
        $item = $q->findPk($id);
        if(isset($item)){
           $item->processParams($params);
           $item->save();
        }
        else{
            throw new \cookbook\NotFoundException(self::class, $id);
        }
        
        
    }
    
    /**
     * Performs the delete CRUD operation.
     * @param type $id the id of the object to be deleted.
     * @throws \cookbook\NotFoundException if the object does not exist.
     */
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

/**
 * Behaviour that provides a convenient way to retrieve all the items ordered by name.
 */
trait RetrieveOrderedByName {
    
    /**
     * Retrieve all the items from this type, ordered by name.
     * @return an array that contains all the data.
     */
    public function retrieveAll(){
        $selectFields = self::$retrieveAllFields;
        $query = $this->select($selectFields)
                ->orderByName()
                ->find();
        $data = $query->getData();
        return $data;
    }
}

