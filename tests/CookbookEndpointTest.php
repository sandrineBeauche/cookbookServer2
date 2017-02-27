<?php

require_once __DIR__ ."/CookbookTest.php";

use cookbook\api\CookbookApp;
use Slim\Http\Request;

class TestableCookbookApp extends CookbookApp {
    public function invoke($env, $body = null) {
        $req = Request::createFromEnvironment($env);
        if($body != null){
            $req = $req->withParsedBody($body);
        }
        
        $this->getContainer()['request'] = $req;
        $response = $this->run(true);
        return $response;
    }
}


abstract class CookbookEndpointTest extends CookbookTest {
    
    public function setUp()
    {
        parent::setUp();
        $_SESSION = array();
        $this->app = new TestableCookbookApp();
    }
    
    protected function withJsonResult($env, $data, $expectedJson, $status){   
        $response = $this->app->invoke($env, $data);
        
        $body = (string) $response->getBody();
        $result = json_decode($body);
        $expected = json_decode($expectedJson);
        
        $this->assertEquals($status, $response->getStatusCode());
        $this->assertEquals($expected, $result);
    }
}

