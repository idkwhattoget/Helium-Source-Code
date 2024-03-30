<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}
?>

<center><h1>What do you want to create lmfao</h1>
<h2>u only can create games for now</h2>
<a href="/app/create/game">Create Game</a>
</center>
<?php 
buildfooter(); 
?>