<?php
use Bitjo\Controller\MensaController;
use Bitjo\Controller\HomeController;

$app->get('/', HomeController::class);

$app->get('/mensa/{id:[0-9]+}', MensaController::class . ':getMensaById');
$app->get('/mensa/{id:[0-9]+}/date/{date:\d\d\d\d-\d\d-\d\d}/week/{week}', MensaController::class . ':getMenuWeekday');