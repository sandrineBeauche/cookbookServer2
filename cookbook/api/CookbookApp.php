<?php
/**
 * The application that handles REST routes and dispatches requests.
 */

namespace cookbook\api;

/**
 * The application that handles REST routes and dispatches requests.
 */
class CookbookApp extends \Slim\App {
    
    function __construct(array $userSettings = array())
    {
        parent::__construct($userSettings);
        
        $this->setupRoutes();
    }
    
    /**
     * Setup the routes to be handled.
     */
    protected function setupRoutes(){
        /** Gets all the units ordered by name. */
        $this->GET('/units', [ 'cookbook\controllers\UnitController', 'doGet']);
        
        /** creates a new unit */
        $this->POST('/units', [ 'cookbook\controllers\UnitController', 'doCreate']);
        
        /** delete a unit */
        $this->DELETE('/units/{id}', [ 'cookbook\controllers\UnitController', 'doDelete']);
    }
}

