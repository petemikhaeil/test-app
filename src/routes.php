<?php
// Routes
use Controller\ParticleController;
//FOR SELECT PAGE

$app->get( '/select', ParticleController::class. ':select');

$app->post('/select', ParticleController::class. ':post_select');

//FOR inserting PARTICLES PAGE

$app->get('/particles', ParticleController::class. ':inserting');


$app->post('/particles', ParticleController::class. ':post_inserting');


//FOR DELETING PAGE

$app->get('/delete', ParticleController::class. ':deleting');


$app->post('/delete', ParticleController::class. ':post_deleting');

