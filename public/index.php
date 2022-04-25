<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$payload = array(
    "code" => 200,
    "message" => "Success",
    "data" => array()
); 

require_once '../models/common.php';
require_once '../models/database.php';
require_once '../models/user.php';
require_once '../routes/user_routes.php';

$app->run();
?>