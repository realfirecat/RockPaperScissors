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
        ->select('id', 'playerRoled','cpuRoled','roledAt')
        ->from('statistik')
        ->orderBy('roledAt','DESC');

    $items = $conn->executeQuery($sql)->fetchAll();
    $stats = [];

    foreach ($items as $item) {
        $winner = \htl3r\rps\php\Round::getWinner($item['playerRoled'],$item['cpuRoled']);
        array_push($stats, [
                'id' => $item['id'],
                'time' => $item['roledAt'],
                'winner' => $winner
            ]);
    }

    echo json_encode(['data' => $stats]);
} catch (Exception $e) {
    echo json_encode(['data' => []]);
}