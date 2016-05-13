<?php
use testnamespace\Config;

Config::set('routingMap', include '_routing.php');


ActiveRecord\Config::initialize(function($cfg) 
	{
	     $cfg->set_model_directory(ROOT.'/src/models/');
	     $cfg->set_connections(array(
	         'development' => 'mysql://user:ASDqwe12U@localhost/scotchbox'));
	});