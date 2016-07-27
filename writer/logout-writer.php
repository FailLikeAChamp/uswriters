<?php
require_once('../app/start.php');

unset($_SESSION['writer_id']);

header('location: login');