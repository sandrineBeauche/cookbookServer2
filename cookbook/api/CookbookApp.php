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
        
        
        
        /** Gets all the countries ordered by name. */
        $this->GET('/countries', [ 'cookbook\controllers\CountryController', 'doGet']);
        
        /** creates a new country */
        $this->POST('/countries', [ 'cookbook\controllers\CountryController', 'doCreate']);
        
        /** updates a country */
        $this->PUT('/countries/{id}', [ 'cookbook\controllers\CountryController', 'doUpdate']);
        
        /** delete a country */
        $this->DELETE('/countries/{id}', [ 'cookbook\controllers\CountryController', 'doDelete']);
    }
}

