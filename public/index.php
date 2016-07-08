<?php

require_once __DIR__ . "/../bootstrap.php";

use Symfony\Component\HttpFoundation\Request;

$app->get('/', function () {
    return 'Hello!';
});

$app->get('/cliente', function () use ($app) {
    $clientes = $app['clienteService']->getAll();
    return $app->json($clientes);
});

$app->post('/cliente', function (Request $request) use ($app) {
    $dados = $request->get('dados');
    $cliente = $app['clienteService']->insert($dados);
    return $app->json($cliente);
});

$app->get('/produto', function () use ($app) {
    $produtos = $app['produtoService']->getAll();
    return $app->json($produtos);
});

$app->post('/produto', function (Request $request) use ($app) {
    $dados = $request->get('dados');
    $produto = $app['produtoService']->insert($dados);
    return $app->json($produto);
});

$app->run();
