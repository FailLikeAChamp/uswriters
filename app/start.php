<?php 
use \Plasticbrain\FlashMessages\FlashMessages;

if (!session_id()) session_start();

require_once(__DIR__ . '/../vendor/autoload.php');

ActiveRecord\Config::initialize(function($config)
{
	$config->set_connections([
		"development" => "mysql://root:root@localhost/uswriters"
	]);
	$config->set_default_connection('development');
});

$loader = new Twig_Loader_Filesystem();
$loader->addPath(__DIR__ . '/../views');
$loader->addPath(__DIR__ . '/../views/admin', 'admin');
$loader->addPath(__DIR__ . '/../views/writer', 'writer');

$twig = new Twig_Environment($loader, array(
    'cache' => false,
));

$root = "/uswriters";

$twig->addGlobal('root', $root);

$flash = new FlashMessages();