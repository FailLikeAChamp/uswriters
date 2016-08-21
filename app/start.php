<?php 
use \Plasticbrain\FlashMessages\FlashMessages;

if (!session_id()) session_start();

require_once(__DIR__ . '/../vendor/autoload.php');

ActiveRecord\Config::initialize(function($config)
{
	$configs = getDbConfigs();
	$dbConfigs = $configs['database'];

	$config->set_connections([
		"production" => "mysql://".$dbConfigs['username'].":".$dbConfigs['password']."@".$dbConfigs['connection']
	]);
	$config->set_default_connection('production');
});

$loader = new Twig_Loader_Filesystem();
$loader->addPath(__DIR__ . '/../views');
$loader->addPath(__DIR__ . '/../views/admin', 'admin');
$loader->addPath(__DIR__ . '/../views/writer', 'writer');

$twig = new Twig_Environment($loader, array(
    'cache' => false,
));

$twig->addGlobal('root', '/uswriters');

$flash = new FlashMessages();