<?php
use Bitjo\Controller\MensaController;
use Bitjo\Controller\HomeController;

$app->get('/', HomeController::class);

$app->get('/mensa/{id:[0-9]+}', MensaController::class . ':getMensaById');
