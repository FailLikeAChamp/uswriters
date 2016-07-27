<?php 
require_once('app/start.php');

isWriterLoggedOut();

header("location: writer/login");