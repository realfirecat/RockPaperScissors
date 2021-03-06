<?php
// doctrineORM.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use htl3r\rps\Config;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/entities"), $isDevMode);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters

// obtaining the entity manager
$entityManager = EntityManager::create(config::getConnectionParams(), $config);