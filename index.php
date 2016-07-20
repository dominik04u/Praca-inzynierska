<?php

session_start();

require_once 'libs/config.php';
require_once 'libs/Router.php';
require_once 'libs/Controller.php';
require_once 'libs/Model.php';
require_once 'libs/View.php';
require_once 'libs/Database.php';

$router = new Router();