<?php

use Nette\Application\Routers\Route;
use Nette\Config\Configurator;

// Load Nette Framework
require LIBS_DIR . '/Nette/Nette/loader.php';

$configurator = new Configurator();
$configurator->enableDebugger(__DIR__ . '/../log');
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
	->addDirectory(APP_DIR)
	->register();
$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addParameters(array('dataDir' => DATA_DIR));
$container = $configurator->createContainer();

$container->router[] = new Route('index.php', 'Homepage:default', Route::ONE_WAY);
$container->router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
