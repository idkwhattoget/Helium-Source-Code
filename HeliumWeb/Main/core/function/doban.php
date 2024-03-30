<?php 
  
  require_once("siteconfig.php");
if($_SERVER['REQUEST_METHOD'] !== "POST") {
  die("no get requests 👀");
}
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}
  $a = (string)$_POST['usertoban'];
  $stmt = $dbcon->prepare("SELECT isadmin FROM users WHERE id=:gid");
  $stmt->bindParam(":gid", $_SESSION['id'], PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row['isadmin'] == 0) {
    header("location: /index.php");
    }
$stmt = $dbcon->prepare("SELECT isadmin FROM users WHERE username=:gusd");
  $stmt->bindParam(":gusd", $a, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($row['isadmin'] > 0) {
    die("u cant ban admins lol");
  }
  
  $stmt2 = $dbcon->prepare("UPDATE users SET isclientbanned = 1 WHERE username = :usertobanlol");
  $stmt2->bindParam(":usertobanlol", $a, PDO::PARAM_STR);
  $stmt2->execute();
  header("Location: /app/admin");
?>