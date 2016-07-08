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

require_once __DIR__ . "/tela.php";

$app->run();
