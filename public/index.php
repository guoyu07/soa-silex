<?php

require_once __DIR__ . "/../bootstrap.php";

$app->get('/', function () {
    return 'Hello!';
});

$app->run();