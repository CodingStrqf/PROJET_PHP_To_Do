<?php
//chargement config
require_once(__DIR__.'/config/config.php');
//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();


//chargement d’un controleur
$FC = new FrontController();
