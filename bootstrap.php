<?php

require_once "vendor/autoload.php";

use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$dbpath = __DIR__ . '/data/db.sqlite3';

$dsn = "sqlite:{$dbpath}";
$pdo = new Pdo($dsn);