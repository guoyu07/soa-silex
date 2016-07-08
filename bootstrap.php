<?php

require_once "vendor/autoload.php";

use Soa\Sistema\Mapper\ClienteMapper;
use Soa\Sistema\Mapper\ProdutoMapper;
use Soa\Sistema\Service\ClienteService;
use Soa\Sistema\Service\ProdutoService;

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

$app['produtoService'] = function () use ($pdo) {
    $produtoMapper = new ProdutoMapper($pdo);
    $produtoService = new ProdutoService($produtoMapper);
    return $produtoService;
};
