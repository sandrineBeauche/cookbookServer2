<?php
require_once __DIR__."/../CookbookEndpointTest.php";

use Slim\Http\Environment;

class CountryEndpointTest extends CookbookEndpointTest {
    
    public function getDataSet(){    
        return parent::generateDataset(array("countries.yml"));
    }
    
    protected function assertCountryRowCount($nbRow){
        $this->assertRowCount($nbRow, 'country');
    }
    
    public function testGetCountries(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/countries',
        ));
        
        $expected = '[{"id":"3", "name":"Chine", "flag": "cn.png"},
                      {"id":"1", "name":"France", "flag": "fr.png"},
                      {"id":"2", "name":"Tunisie", "flag": "tn.png"}]';
        
        $this->withJsonResult($env, null, $expected, 200);
    }
    
    public function testCreateCountry(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => '/countries',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'Canada', 'flag' => 'http://www.drapeauxdespays.fr/data/flags/mini/ca.png');
        
        $expected = '{"id":"4"}';
        
        $this->withJsonResult($env, $data, $expected, 201);
        $this->assertCountryRowCount(4);
    }
    
    public function testCreateCountryValidationError(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'POST',
            'REQUEST_URI'    => '/countries',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'France', 'flag' => 'http://www.drapeauxdespays.fr/data/flags/mini/fr.png');
        
        $expected = '{"name":"existe déjà"}';
        
        $this->withJsonResult($env, $data, $expected, 400);
        $this->assertCountryRowCount(3);
    }
    
    
    public function testUpdateCountry(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'PUT',
            'REQUEST_URI'    => '/countries/1',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'Canada', 'flag' => 'http://www.drapeauxdespays.fr/data/flags/mini/ca.png');
        
        $response = $this->app->invoke($env, $data);
        
        $this->assertEquals(200, $response->getStatusCode());
    }
    
    public function testUpdateCountryNotFound(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'PUT',
            'REQUEST_URI'    => '/countries/10',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'Canada', 'flag' => 'http://www.drapeauxdespays.fr/data/flags/mini/ca.png');
        
        $response = $this->app->invoke($env, $data);
        
        $this->assertEquals(404, $response->getStatusCode());
    }
    
    public function testUpdateCountryValidationException(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'PUT',
            'REQUEST_URI'    => '/countries/1',
            'CONTENT_TYPE'   => 'application/x-www-form-urlencoded'
        ));
        
        $data = array('name' => 'Tunisie', 'flag' => 'http://www.drapeauxdespays.fr/data/flags/mini/ca.png');
        
        $expected = '{"name":"existe déjà"}';
        
        $this->withJsonResult($env, $data, $expected, 400);
    }
    
    public function testDeleteCountry(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'DELETE',
            'REQUEST_URI'    => '/countries/1'
        ));
        
        $response = $this->app->invoke($env, null);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCountryRowCount(2);
    }
    
    public function testDeleteCountryNotFound(){
        $env = Environment::mock(array(
            'REQUEST_METHOD' => 'DELETE',
            'REQUEST_URI'    => '/countries/10'
        ));
        
        $response = $this->app->invoke($env, null);
        
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertCountryRowCount(3);
    }
}

