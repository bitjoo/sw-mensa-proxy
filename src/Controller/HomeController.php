<?php
namespace Bitjo\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Monolog\Logger;

class HomeController {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function __invoke($req, $res, $args) {
        // Sample log message
        $this->container->logger->info("Slim-Skeleton '/' route");

        // Render index view
        return $this->container->renderer->render($res, 'index.phtml', $args);
    }
}