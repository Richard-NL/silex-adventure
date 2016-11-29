#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Knp\Provider\ConsoleServiceProvider;
use Rsh\Adventure\Command\AdventureCommand;


$app = new \Silex\Application();

$app->register(new ConsoleServiceProvider(), [
    'console.name'              => 'Silex Console',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/.'
]);

$application = $app['console'];
$application->add(new AdventureCommand());
$application->run();

