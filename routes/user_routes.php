<?php 

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once '../models/user.php';

$app->get('/users', function($request, $response, $args){
    global $payload;
    $user = new User(); 

    $result = $user->getUser(); 
   
    if($result && count($result) > 0) {
        $payload["data"] = $result;
    }
    else {
        $payload["message"] = "Failed";
    }   
    return $user->apiResponse($response, $payload, $payload['code']);
});

$app->post('/users', function($request, $response, $args){
    global $payload;
    $err = '';
    $user = new User(); 

    $input = $request->getBody();
    $input=json_decode($input,true);

    if(!$input['name'])  $err = "Name is required";  
    elseif (!$input['email']) $err = "Email is required";   
    elseif(!$input['password']) $err = "Password is required";
    elseif(!$input['phone_number']) $err = "Phone number is required";
    else {
        $result = $user->insertUser($input['name'], $input['email'], $input['password'], $input['phone_number']); 
        if($result) {
            $payload["data"] = $result;
            $payload["message"] = "User inserted successfully";
        }
        else {
            $payload["code"] = 500;
            $payload["message"] = "Failed inserting user";
        }
    }

    if($err != null) {
        $payload['code'] = 404;
        $payload['message'] = $err;
    }

    return $user->apiResponse($response, $payload, $payload['code']);
});

//DELETE APIs
$app->delete('/users', function($request, $response, $args){

    global $payload;
    $err = '';
    $user = new User(); 

    $input = $request->getBody();
    $input=json_decode($input,true);

    if(!$input['id'])  $err = "Id is required";  
    else {
        $result = $user->deleteUser($input['id']); 
        if($result) {
            $payload["data"] = $result;
            $payload["message"] = "User deleted successfully";
        }
        else {
            $payload["code"] = 500;
            $payload["message"] = "Failed deleting user";
        }
    }

    if($err != null) {
        $payload['code'] = 404;
        $payload['message'] = $err;
    }

    return $user->apiResponse($response, $payload, $payload['code']);
});


//PUT
$app->put('/users', function($request, $response, $args){

    global $payload;
    $err = '';
    $user = new User(); 

    $input = $request->getBody();
    $input=json_decode($input,true);

    if(!$input['id'])  $err = "Id is required";  
    else {
        $result = $user->updateUser($input['id'], $input['name'], $input['email'], $input['phone_number']); 
       
        if($result) {
            $payload["data"] = $result;
            $payload["message"] = "User update successfully";
        }
        else {
            $payload["code"] = 500;
            $payload["message"] = "Failed Upadteing user";
        }
    }

    if($err != null) {
        $payload['code'] = 404;
        $payload['message'] = $err;
    }

    return $user->apiResponse($response, $payload, $payload['code']);
});



?>