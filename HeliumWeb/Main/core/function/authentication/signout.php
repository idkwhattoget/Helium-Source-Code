<?php
session_name("HELIUM_AUTHENTICATION");
session_start();
$_SESSION = array();
session_destroy();
header("location: /app/login");
die();
