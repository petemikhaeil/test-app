<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['db'] = function($c){
    $settings = $c->get('settings')['db'];
    $db = new mysqli($settings['host'], $settings['username'], $settings['passwd'], $settings['dbname']);
    return $db;
};

$container[\Controller\ParticleController::class] = function ($c){
  return new \Controller\ParticleController($c->get('logger'), $c->get('db'), $c->get('renderer'));
};