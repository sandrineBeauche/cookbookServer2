<?php

require_once __DIR__."/../../CookbookValidationTest.php";

use cookbook\cookbook\Country;

class CountryValidationTest extends CookbookValidationTest {
    
    public function getDataSet(){    
        return parent::generateDataset(array("countries.yml"));
    }
    
    public function testValidateCountry1(){
        $params = ["name" => "Belgique", "flag" => "http://www.blabla.fr/be"];
        $result = $this->processParamsAndValidate(Country::class, $params);
        $this->assertTrue($result);
    }
    
    public function testValidateCountry2(){
        $params = ["name" => "Italie", "flag" => ""];
        $result = $this->processParamsAndValidate(Country::class, $params);
        $this->assertTrue($result);
    }
    
    public function testValidateCountry_InvalidName(){
        $params = ["name" => "123", "flag" => ""];
        $result = $this->processParamsAndValidate(Country::class, $params);
        $this->assertFalse($result);
    }
    
    public function testValidateCountry_InvalidName2(){
        $params = ["name" => "bla bla", "flag" => ""];
        $result = $this->processParamsAndValidate(Country::class, $params);
        $this->assertFalse($result);
    }
    
    public function testValidateCountry_AlreadyExist(){
        $params = ["name" => "France", "flag" => ""];
        $result = $this->processParamsAndValidate(Country::class, $params);
        $this->assertFalse($result);
    }
}

