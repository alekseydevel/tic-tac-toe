<?php
require __DIR__.'/vendor/autoload.php';

use Game\Command\GameApp;
use Game\Infrastructure\Storage\LocalFileStorage;

$app = new GameApp(
    new LocalFileStorage(__DIR__ . '/storage/memory.json')
);

$app->run();
