<?php
require_once('../app/start.php');

unset($_SESSION['admin_id']);
unset($_SESSION['admin_username']);

header('location: login');