<?php

putenv("env=test");
require __DIR__ ."/../vendor/autoload.php";
require_once __DIR__ .'/../conf/config.php';

abstract class CookbookTest extends PHPUnit_Extensions_Database_TestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
        $connection = $serviceContainer->getConnection('default')->getWrappedConnection();
        return $this->createDefaultDBConnection($connection, 'cookbook');
    }

    protected function generateDataset(array $datasetFiles){   
        $datasets = array();
        foreach($datasetFiles as $currentDataset){
            $datasets[] = new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
                dirname(__FILE__)."/datasets/".$currentDataset
            );
        }
        
        $compositeDs = new PHPUnit_Extensions_Database_DataSet_CompositeDataSet($datasets);
        return $compositeDs;
    }
    
    
}