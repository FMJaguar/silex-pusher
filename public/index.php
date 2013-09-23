<?php
require_once __DIR__.'/../vendor/autoload.php'; 

$app = new Silex\Application(); 

$env = require( __DIR__ . '/../.env.php');
foreach ($env as $k => $v){
	putenv($k.'='.$v);
}

$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/../views',
	'twig.options' => ['debug' => true]
));

$app->get('/hello/{name}', function($name) use($app) { 
	return 'Hello'.$app->escape($name);
}); 

$app->get('/', function() use($app) { 
	return $app['twig']->render('index.html.twig',['pusher_key' => getenv('PUSHER_KEY')]);
}); 


return $app;
