<?php

require_once "vendor/autoload.php";

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;
