<?php

require_once __DIR__ ."/CookbookTest.php";

abstract class CookbookValidationTest extends CookbookTest {
    
    protected function processParamsAndValidate(string $className, $params){
        $item = new $className();
        $this->invokeMethod($item, "processParams", [$params]);
        $result = $item->validate();
        if(!$result){
            foreach ($item->getValidationFailures() as $failure){
                echo "Property ".$failure->getPropertyPath().": ".$failure->getMessage()."\n";
            }
        }
        return $result;
    }
    
    
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    protected function invokeMethod(&$object, $methodName, array $parameters = array()) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

}

