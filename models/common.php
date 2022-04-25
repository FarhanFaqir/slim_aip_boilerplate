<?php

class Common extends Database{
    function apiResponse($response,$payload,$statusCode = 200) {
        $payload = json_encode($payload);
        $response->getBody()->write($payload);   
        return $response
          ->withHeader('Access-Control-Allow-Origin', '*')
          ->withHeader('Access-Control-Allow-Headers','*')
          ->withHeader('Access-Control-Allow-Credentials', 'true')
          ->withHeader('Content-Type', 'application/json')
          ->withStatus($statusCode);
    }
}

?>