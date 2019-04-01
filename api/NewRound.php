<?php
/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 08.03.2019
 * Time: 23:29
 */
require_once '../vendor/autoload.php';
use htl3r\rps\php\Round;

$valid=false;
$gewonnen=false;
try {
    $newRound = new Round();
    $cpuChoice = $newRound->newRound($_GET['choice']);
    $valid=true;
    $gewonnen=Round::getWinner($_GET['choice'],$cpuChoice);
} catch (Exception $e) {}

echo json_encode([
    'valid' => $valid,
    'gewonnen' => $gewonnen
]);