<?php
require_once('../app/start.php');

unset($_SESSION['writer_id']);
unset($_SESSION['writer_name']);

header('location: login');