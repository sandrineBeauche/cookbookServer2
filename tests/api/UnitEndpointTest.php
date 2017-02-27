<?php
require_once __DIR__."/../CookbookEndpointTest.php";

use Slim\Http\Environment;

class UnitEndpointTest extends CookbookEndpointTest {
    
    public function getDataSet(){    
        return parent::generateDataset(array("units.yml"));
    }
    
    protected function assertUnitRowCount(int $nbRow){
        $this->assertRowCount($nbRow, 'unit');
    }
    
    public function testGetUnit(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/units',
        ));
        
        $expected = '[{"id":"3", "name":"cas"},
                      {"id":"2", "name":"cl"},
                      {"id":"1", "name":"gr"}]';
        
        $this->withJsonResult($env, null, $expected, 200);
    }
    
    public function testCreateUnit(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => '/units',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'kg');
        
        $expected = '{"id":"4"}';
        
        $this->withJsonResult($env, $data, $expected, 201);
        $this->assertUnitRowCount(4);
    }
    
    public function testCreateUnitValidationError(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => '/units',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'gr');
        
        $expected = '{"name":"existe déjà"}';
        
        $this->withJsonResult($env, $data, $expected, 400);
        $this->assertUnitRowCount(3);
    }
    
    public function testDeleteUnit(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'DELETE',
            'REQUEST_URI'    => '/units/1'
        ));
        
        $response = $this->app->invoke($env, null);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertUnitRowCount(2);
    }
    
    public function testDeleteUnitNotFound(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'DELETE',
            'REQUEST_URI'    => '/units/10'
        ));
        
        $response = $this->app->invoke($env, null);
        
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertUnitRowCount(3);
    }
}

