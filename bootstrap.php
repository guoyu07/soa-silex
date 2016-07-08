<?php

require_once "vendor/autoload.php";

use Soa\Sistema\Mapper\ClienteMapper;
use Soa\Sistema\Service\ClienteService;

$app = new Silex\Application();
$app['debug'] = true;

$dbpath = __DIR__ . '/data/db.sqlite3';

$dsn = "sqlite:{$dbpath}";
$pdo = new Pdo($dsn);

$app['clienteService'] = function () use ($pdo) {
    $clienteMapper = new ClienteMapper($pdo);
    $clienteService = new ClienteService($clienteMapper);
    return $clienteService;
};
