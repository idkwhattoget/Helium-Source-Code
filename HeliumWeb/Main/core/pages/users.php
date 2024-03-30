<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}
  $stmt = $dbcon->prepare("SELECT isadmin FROM users WHERE id=:gid");
  $stmt->bindParam(":gid", $_SESSION['id'], PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<style>
  .thing {
    display: inline-block;

    border-style: solid;
    padding: 10px;
    border-width: 5px
    text-align: center;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

</style>
<center><h1>Users</h1>
  <div class="thing">
<?php 
  $stmt = $dbcon->prepare("SELECT * FROM users WHERE isclientbanned=0 ORDER BY `id` ASC");
  $stmt->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<p style='font-size: 45px;'>".$row['username']."</p><hr>";
    }
  
  ?></div></center>
<?php
buildfooter();
?>