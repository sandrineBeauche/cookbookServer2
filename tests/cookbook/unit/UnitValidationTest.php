<?php

require_once __DIR__."/../../CookbookValidationTest.php";

use cookbook\cookbook\Unit;

class UnitValidationTest extends CookbookValidationTest {
    
    public function getDataSet(){    
        return parent::generateDataset(array("units.yml"));
    }
    
    public function testValidateUnit(){
        $params = ["name" => "kg"];
        $result = $this->processParamsAndValidate(Unit::class, $params);
        $this->assertTrue($result);
    }
    
    public function testValidateUnit_InvalidName(){
        $params = ["name" => "123"];
        $result = $this->processParamsAndValidate(Unit::class, $params);
        $this->assertFalse($result);
    }
    
    public function testValidateUnit_InvalidName2(){
        $params = ["name" => "bla bla"];
        $result = $this->processParamsAndValidate(Unit::class, $params);
        $this->assertFalse($result);
    }
    
    public function testValidateUnit_AlreadyExist(){
        $params = ["name" => "gr"];
        $result = $this->processParamsAndValidate(Unit::class, $params);
        $this->assertFalse($result);
    }
}

