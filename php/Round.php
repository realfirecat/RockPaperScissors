<?php

namespace htl3r\rps\php;

/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 08.03.2019
 * Time: 21:15
 */

//require_once "../vendor/autoload.php";
//require_once "../config.php";
use \htl3r\rps\entities\Statistik;
use \htl3r\rps\entities\Roletypes;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use \htl3r\rps\config;

class Round {
    public $playerChoice;
    public $cpuChoice;
    protected $entityManager;

    public function __construct()
    {
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/entities"), $isDevMode);
        try {
            $this->entityManager = EntityManager::create(config::getConnectionParams(), $config);
        } catch (Exception $e){}
    }

    public function newRound($playerChoice){
        $this->playerChoice=$playerChoice;
        $this->cpuChoice=rand(1,3);
        $this->insertNewStatisticEntry();
        return $this->cpuChoice;
    }

    public function insertNewStatisticEntry(){
        try {
            $newStatistic = new Statistik();

            $cpuRole = $this->entityManager->find("\\htl3r\\rps\\entities\\Roletypes", $this->cpuChoice);
            $playerRole = $this->entityManager->find("\\htl3r\\rps\\entities\\Roletypes", $this->playerChoice);
            $newStatistic->setCpuRoled($cpuRole);
            $newStatistic->setPlayerRoled($playerRole);
            $newStatistic->setRoledAt(new \DateTime());

            $this->entityManager->persist($newStatistic);
            $this->entityManager->flush();

            return true;
        } catch (Exception $e){
            var_dump($e->getMessage());
            return false;
        }
    }
    
    public static function getWinner($player, $cpu){
        /*
         * 1 = Paper
         * 2 = Rock
         * 3 = Scissor
         */
        $winner = null;
        switch ($cpu) {
            case 1:
                if ($player == 2) {
                    $winner = 'cpu';
                } else if ($player == 3) {
                    $winner = 'player';
                } else if ($player == 1) {
                    $winner = 'tie';
                }
                break;
            case 2:
                if ($player == 2) {
                    $winner = 'tie';
                } else if ($player == 3) {
                    $winner = 'cpu';
                } else if ($player == 1) {
                    $winner = 'player';
                }
                break;
            case 3:
                if ($player == 2) {
                    $winner = 'player';
                } else if ($player == 3) {
                    $winner = 'tie';
                } else if ($player == 1) {
                    $winner = 'cpu';
                }
                break;
        }
        return $winner;
    }
}