<?php 
require __DIR__.'/vendor/autoload.php';
include_once 'loginfo.php';
include_once 'app/RouteAction.php';
$app = new \Slim\App;

$containter = $app ->getContainer();

$containter ['RouteAction'] = function ($c){
    return new RouteAction();
    
};

$settings = $containter->get('settings');
$settings->replace(['displayerrordetails' => true,'determinedroutebeforeappmiddleware' => true]);
$app->get('/', RouteAction:: class.':index');
$app->get('/trips', RouteAction:: class.':gettrips');   
$app->get('/trips/keyword/{keyword}', RouteAction:: class.':searchtrip');
$app->post('/trips', RouteAction:: class.':addtrip');
$app->put('/trips/id/{id}', RouteAction:: class.':updatetrip');
$app->delete('/delete/{id}',RouteAction:: class.':deletetrip');
$app->get('/trips/{id}', RouteAction:: class.':gettrip');

$app->run();
