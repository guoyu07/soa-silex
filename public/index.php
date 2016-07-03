<?php

require_once __DIR__ . "/../bootstrap.php";

$app->get('/', function () {
    return 'Hello!';
});

$app->get('/cliente', function () use ($app, $pdo) {
    $clientes = $pdo->query("SELECT * FROM clientes");

    return $app->json($clientes->fetchAll(PDO::FETCH_ASSOC));
});

$app->run();