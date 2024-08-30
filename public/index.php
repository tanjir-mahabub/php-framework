<?php
/**
 * User: Md. Tanjir Mahabub
 */

use app\core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));


$app->router->get('/', 'home');

 $app->router->get('/contact', 'contact');

$app->run();