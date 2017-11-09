<?php
namespace Bitjo\Controller;

use Carbon\Carbon;
use Slim\Http\Request;
use Slim\Http\Response;

class TabsController {

    protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

    private function mapWeek($weekDayString, $weekDate) {
        return array(
            'day' => $weekDayString,
            'date' => $weekDate
        );
    }

    public function load(Request $request, Response $response, array $args) {
        $this->container->logger->info('TabsController:load "/tabs/date/{date}/day/{day}" route; ' . implode(", ", $args));

        $weekDayStrings = array("Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");

        $date = Carbon::createFromFormat('Y-m-d', $args['date']);
        $startWeekDate = $date->subDays($args['day']);

        $weekDates = array();
        for ($i = 0; $i < count($weekDayStrings); $i++) {
            $weekDates[] = $startWeekDate->addDay(1)->toDateString();
        }

        $week = array_map(array($this, 'mapWeek'), $weekDayStrings, $weekDates);

        return $this->container->renderer->render($response, 'tabs.phtml', [
            'week' => $week
        ]);
    }
}