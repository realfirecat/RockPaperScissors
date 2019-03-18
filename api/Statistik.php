<?php
/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 09.03.2019
 * Time: 13:56
 */

require_once "../vendor/autoload.php";

use Doctrine\DBAL\DriverManager;
use htl3r\rps\config;

try {
    $conn = DriverManager::getConnection(config::getConnectionParams());
    $queryBuilder = $conn->createQueryBuilder();

    $sql = $queryBuilder
        ->select('playerRoled','cpuRoled','roledAt')
        ->from('statistik')
        ->orderBy('roledAt','DESC');

    $items = $conn->executeQuery($sql)->fetchAll();
    $stats = [];


    /*
     * 1 = Rock
     * 2 = Scissor
     * 3 = Paper
     * */
    foreach ($items as $item) {
        $winner = null;
        switch ($item['cpuRoled']) {
            case 1:
                if ($item['playerRoled'] == 2) {
                    $winner = 'cpu';
                } else if ($item['playerRoled'] == 3) {
                    $winner = 'player';
                } else if ($item['playerRoled'] == 1) {
                    $winner = 'tie';
                }
                break;
            case 2:
                if ($item['playerRoled'] == 2) {
                    $winner = 'tie';
                } else if ($item['playerRoled'] == 3) {
                    $winner = 'player';
                } else if ($item['playerRoled'] == 1) {
                    $winner = 'cpu';
                }
                break;
            case 3:
                if ($item['playerRoled'] == 2) {
                    $winner = 'cpu';
                } else if ($item['playerRoled'] == 3) {
                    $winner = 'cpu';
                } else if ($item['playerRoled'] == 1) {
                    $winner = 'player';
                }
                break;
        }
        array_push($stats, [
                'time' => $item['roledAt'],
                'winner' => $winner
            ]);
    }

    echo json_encode(['data' => $stats]);
} catch (Exception $e) {
    echo json_encode(['data' => []]);
}