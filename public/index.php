<?php
require '../vendor/autoload.php';

$app = new \Slim\App();

//Config Handler Error
$handlerError = new \App\Config\HandlerError($app->getContainer());
$handlerError->activate();

//Config Register Access
$app->add(new \App\Middleware\RegisterAccessMiddleware);

// Define app routes
$routes = new \App\Route\Route($app);
$routes->activate();

// Run app
$app->run();