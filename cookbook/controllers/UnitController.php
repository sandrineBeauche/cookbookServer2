<?php
/**
 * The controller that exposes Unit data.
 */

namespace cookbook\controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use cookbook\cookbook\UnitQuery as UnitQuery;

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
}