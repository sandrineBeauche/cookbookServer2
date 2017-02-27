<?php

require_once __DIR__ ."/CookbookTest.php";

use cookbook\api\CookbookApp;
use Slim\Http\Request;

class TestableCookbookApp extends CookbookApp {
    public function invoke($env) {
        $req = Request::createFromEnvironment($env);
        $this->getContainer()['request'] = $req;
        $response = $this->run(true);
        return $response;
    }
}


abstract class CookbookEndpointTest extends CookbookTest {
    
    public function setUp()
    {
        $_SESSION = array();
        $this->app = new TestableCookbookApp();
    }
    
    protected function withJsonResult($env, $expectedJson){   
        $response = $this->app->invoke($env);
        
        $body = (string) $response->getBody();
        $result = json_decode($body);
        $expected = json_decode($expectedJson);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($expected, $result);
    }
}

