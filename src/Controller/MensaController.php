<?php
namespace Bitjo\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;

class MensaController {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function getMensaById(Request $req, Response $res, array $args) {
        // Sample log message
        $this->container->logger->info('MensaController:getMensaById "/mensa/{id}" route; id: ' . $args['id']);

        $client = new Client();
        try {
            $clientRes = $client->request('POST', 'https://www.stw.berlin/xhr/speiseplan-und-standortdaten.html', [
                'form_params' => [
                    'resources_id' => $args['id']
                ]
            ]);
        } catch (ServerException $e) {
            return $res->withRedirect("/");
        }

        $this->container->logger->info("MensaController:getMensaById request status code: " . $clientRes->getStatusCode());

        $base_path = $req->getUri()->getScheme() . "://" . $req->getUri()->getHost();

        if ($req->getUri()->getHost() == "localhost") {
            $base_path .= ":8080";
        }

        // Render index view
        return $this->container->renderer->render($res, 'mensa.phtml', [
            'mensa_html' => $clientRes->getBody(),
            'base_path' => $base_path
        ]);
    }

    public function getMenuWeekday(Request $request, Response $response, array $args) {
        $this->container->logger->info('MensaController:getMenuWeek "/mensa/{id}/date/{date}/week/{week}" route; ' . implode(", ", $args));
        $client = new Client();
        try {
            $clientRes = $client->request('POST', 'https://www.stw.berlin/xhr/speiseplan-wochentag.html', [
                'form_params' => [
                    'resources_id' => $args['id'],
                    'date' => $args['date'],
                    'week' => $args['week']
                ]
            ]);
        } catch (ServerException $e) {
            return $response->withRedirect("/");
        }

        $this->container->logger->info("MensaController:getMenuWeek request status code: " . $clientRes->getStatusCode());

        return $response->withBody($clientRes->getBody());
    }
}