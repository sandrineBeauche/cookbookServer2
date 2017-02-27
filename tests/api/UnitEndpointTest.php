<?php
require_once __DIR__."/../CookbookEndpointTest.php";

use Slim\Http\Environment;

class UnitEndpoingTest extends CookbookEndpointTest {
    
    public function getDataSet(){    
        return parent::generateDataset(array("units.yml"));
    }
    
    public function testGetUnit(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/units',
        ));
        
        $expected = '[{"id":"3", "name":"cas"},
                      {"id":"2", "name":"cl"},
                      {"id":"1", "name":"gr"}]';
        
        $this->withJsonResult($env, $expected);
    }
}

