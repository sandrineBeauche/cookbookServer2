<?php

namespace cookbook\controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use cookbook\ValidationFailureException;
use cookbook\CookbookException;


function getItemClassname($controllerClassname){
    $itemClass = substr(strrchr($controllerClassname, "\\"), 1, -10);
    return "cookbook\cookbook\\".$itemClass;
}
    
    
function getItemQueryClassname($controllerClassname){
    $itemClass = substr(strrchr($controllerClassname, "\\"), 1, -10);
    return "cookbook\cookbook\\".$itemClass.'Query';
}
    
function getItemQueryInstance($controllerClassname){
    $classname = getItemQueryClassname($controllerClassname);
    return call_user_func(array($classname, 'create'));
}



trait GetAllOrderedByNameAction {
    
    /**
     * Performs the request to get all the units ordered by name
     * @param Request $request the http request
     * @param Response $response the resulting http response
     * @param type $args the request arguments
     * @return Response the resulting http request.
     */
    public static function doGet(Request $request, Response $response, $args){        
        $query = getItemQueryInstance(self::class);
        $items = $query->retrieveAll();
        $response->getBody()->write(json_encode($items));
        return $response;
    }
}


trait CreateAction {
    
    /**
     * Performs the request to create a new unit.
     * @param Request $request the http request
     * @param Response $response the resulting http response
     * @param type $args the request arguments
     * @return Response the resulting http request.
     */
    public static function doCreate(Request $request, Response $response, $args) {
        $itemClassname = getItemClassname(self::class); 
        
        $data = $request->getParsedBody();
        
        try{
            $newItem = $itemClassname::create($data);
            $result = array("id" => $newItem->getId());
            $response->getBody()->write(json_encode($result));
            return $response->withStatus(201);
        }
        catch(ValidationFailureException $ex){
            $errors = json_encode($ex->getErrors());
            $response->getBody()->write($errors);
            return $response->withStatus($ex->getHttpCode());
        }
    }
}


trait UpdateAction {
    
    public static function doUpdate(Request $request, Response $response, $args) {
        $itemClassname = getItemClassname(self::class); 
        $id = $args["id"];
        $data = $request->getParsedBody();
        
        try{
            $itemClassname::update($id, $data);
            return $response->withStatus(200);
        } 
        catch(ValidationFailureException $ex){
            $errors = json_encode($ex->getErrors());
            $response->getBody()->write($errors);
            return $response->withStatus($ex->getHttpCode());
        }
        catch (CookbookException $ex) {
            $response->getBody()->write($ex->getMessage());
            return $response->withStatus($ex->getHttpCode());
        }
    }
    
}

trait DeleteAction {
    
    /**
     * Performs the request to delete an unit.
     * @param Request $request the http request
     * @param Response $response the resulting http response
     * @param type $args the path args. 
     * @return the resulting http response
     */
    public static function doDelete(Request $request, Response $response, $args) {
        $itemClassname = getItemClassname(self::class); 
        $id = $args["id"];
        try{
            $itemClassname::remove($id);
            return $response->withStatus(200);
        } 
        catch (CookbookException $ex) {
            $response->getBody()->write($ex->getMessage());
            return $response->withStatus($ex->getHttpCode());
        }
    }
}