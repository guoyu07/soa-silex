<?php

use Symfony\Component\HttpFoundation\Request;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../views',
));

// Clientes
$app->get('/clientes', function () use ($app) {
    $clientes = $app['clienteService']->getAll();
    return $app['twig']->render('clientes.twig', ['clientes' => $clientes]);
})->bind('clientes');

$app->get('/clientes/new', function () use ($app) {
    $retorno = [
        'cliente' => (new Soa\Sistema\Entity\Cliente([]))->toArray(),
    ];
    return $app['twig']->render('cliente.twig', $retorno);
})->bind('cliente/new');

$app->get('/clientes/{id}', function ($id) use ($app) {
    $cliente = $app['clienteService']->get($id);
    return $app['twig']->render('cliente.twig', ['cliente' => $cliente]);
})->bind('cliente');

$app->post('/clientes', function (Request $request) use ($app) {
    $dados = $request->get('dados');
    $retorno = $app['clienteService']->save($dados);

    return $app['twig']->render('cliente.twig', $retorno);
})->bind('cliente/save');

$app->get('/clientes/delete/{id}', function ($id) use ($app) {
    $retorno = $app['clienteService']->delete($id);
    return $app->redirect('/clientes');
})->bind('cliente/delete');

// Produtos
$app->get('/produtos', function () use ($app) {
    $produtos = $app['produtoService']->getAll();
    return $app['twig']->render('produtos.twig', ['produtos' => $produtos]);
})->bind('produtos');

$app->get('/produtos/new', function () use ($app) {
    $retorno = [
        'produto' => (new Soa\Sistema\Entity\Produto([]))->toArray(),
    ];
    return $app['twig']->render('produto.twig', $retorno);
})->bind('produto/new');

$app->get('/produtos/{id}', function ($id) use ($app) {
    $produto = $app['produtoService']->get($id);
    return $app['twig']->render('produto.twig', ['produto' => $produto]);
})->bind('produto');

$app->post('/produtos', function (Request $request) use ($app) {
    $dados = $request->get('dados');
    $retorno = $app['produtoService']->save($dados);

    return $app['twig']->render('produto.twig', $retorno);
})->bind('produto/save');

$app->get('/produtos/delete/{id}', function ($id) use ($app) {
    $retorno = $app['produtoService']->delete($id);
    return $app->redirect('/produtos');
})->bind('produto/delete');
