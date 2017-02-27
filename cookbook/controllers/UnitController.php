<?php
/**
 * The controller that exposes Unit data.
 */

namespace cookbook\controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use cookbook\cookbook\UnitQuery as UnitQuery;
use cookbook\cookbook\Unit as Unit;
use cookbook\ValidationFailureException;
use cookbook\CookbookException;


/**
 * The controller that exposes Unit data.
 */
class UnitController {
    
    /**
     * Performs the request to get all the units ordered by name
     * @param Request $request the http request
     * @param Response $response the resulting http response
     * @param type $args the request arguments
     * @return Response the resulting http request.
     */
    public static function doGet(Request $request, Response $response, $args) {
        $units = UnitQuery::create()->retrieveAll();
        $response->getBody()->write(json_encode($units));
        return $response;
    }
    
    /**
     * Performs the request to create a new unit.
     * @param Request $request the http request
     * @param Response $response the resulting http response
     * @param type $args the request arguments
     * @return Response the resulting http request.
     */
    public static function doCreate(Request $request, Response $response, $args) {
        $data = $request->getParsedBody();
        
        try{
            $newUnit = Unit::create($data);
            $result = array("id" => $newUnit->getId());
            $response->getBody()->write(json_encode($result));
            return $response->withStatus(201);
        }
        catch(ValidationFailureException $ex){
            $errors = json_encode($ex->getErrors());
            $response->getBody()->write($errors);
            return $response->withStatus($ex->getHttpCode());
        }
    }
    
    /**
     * Performs the request to delete an unit.
     * @param Request $request the http request
     * @param Response $response the resulting http response
     * @param type $args the path args. 
     * @return the resulting http response
     */
    public static function doDelete(Request $request, Response $response, $args) {
        $id = $args["id"];
        try{
            Unit::remove($id);
            return $response->withStatus(200);
        } 
        catch (CookbookException $ex) {
            $response->getBody()->write($ex->getMessage());
            return $response->withStatus($ex->getHttpCode());
        }
    }
}