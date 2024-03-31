<?php

require './vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


$loader = new FilesystemLoader(__DIR__.'/templates');
$view = new Environment($loader);