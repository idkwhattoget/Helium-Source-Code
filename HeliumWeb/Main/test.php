<?php
 $lol = $_GET['peeshit'] ?? "lol idk"; 
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}
  echo password_hash($lol, PASSWORD_ARGON2ID);
?>
<link rel="stylesheet" type="text/css" href="/css/helium.css">
<div class="subnav">xdd</div>