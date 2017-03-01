<?php
require_once __DIR__."/../CookbookTest.php";

use cookbook\cookbook\Unit as Unit; 
use cookbook\cookbook\UnitQuery as UnitQuery;

class CrudSimpleItemTest extends CookbookTest {
    
    public function getDataSet(){    
        return parent::generateDataset(array("units.yml"));
    }
    
    
    
    public function testCreateSimpleItem(){
        $name = "kg";
        $newUnit = Unit::create(["name" => $name]);
        
        $id = $newUnit->getId();
        
        $actual = UnitQuery::create()->findById($id)->getFirst();
        $this->assertEquals($name, $actual->getName());
        $this->assertTableRowCount('unit', 4);
    }
    
    
    public function testCreateSimpleItem_Invalid() {
        $this->expectException(cookbook\ValidationFailureException::class);

        try{
            $name = "123";
            Unit::create(["name" => $name]);
        }
        catch(Exception $ex){
            $this->assertTableRowCount('unit', 3);
            throw $ex;
        }
    }
    
    
    public function testUpdateSimpleItem(){
        Unit::update(1, ["name" => "bla"]);
        
        $unit = UnitQuery::create()->findPk(1);
        $this->assertEquals("bla", $unit->getName());
    }
    
    
    public function testUpdateSimpleItem_invalid(){
        $this->expectException(cookbook\ValidationFailureException::class);
        
        try{
            Unit::update(1, ["name" => "123"]);
        }
        catch(Exception $ex){
            $unit = UnitQuery::create()->findPk(1);
            $unit->reload();
            $this->assertEquals("gr", $unit->getName());
            throw $ex;
        }
    }
    
    
    public function testDeleteSimpleItem(){
        Unit::remove(1);
        $this->assertTableRowCount('unit', 2);
    }
    
    
    public function testDeleteSimpleIem_NotFound(){
        $this->expectException(cookbook\NotFoundException::class);
        
        try{
            Unit::remove(5);
        }
        catch(Exception $ex){
            $this->assertTableRowCount('unit', 3);
            throw $ex;
        }
    }
    
    public function testRetrieveAllSimpleItem(){
        $data = UnitQuery::create()->retrieveAll();
        $expected = [["id" => 3, "name" => "cas"],
                     ["id" => 2, "name" => "cl"],
                     ["id" => 1, "name" => "gr"]];
        $this->assertEquals($expected, $data);
    }
}
