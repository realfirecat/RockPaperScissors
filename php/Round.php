<?php

namespace htl3r\rps\php;

/**
 * Created by PhpStorm.
 * User: Max-Game
 * Date: 08.03.2019
 * Time: 21:15
 */

require_once "../vendor/autoload.php";
require_once "../config.php";
use \htl3r\rps\entities\Statistik;
use \htl3r\rps\entities\Roletypes;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use \htl3r\rps\config;

class Round {
    protected $playerChoice;
    protected $cpuChoice;
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
        } catch (Exception $e){
            var_dump($e->getMessage());
        }
    }
}