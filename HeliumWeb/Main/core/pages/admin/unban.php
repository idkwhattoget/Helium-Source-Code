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
  
  if ($row['isadmin'] == 0) {
    header("location: /index.php");
    }
 
?>

<center><h1>unbanning</h1>
<h2><b>only unban someone if you have a specific reason to</b></h2>
  <form method="post" action="/app/admin/dounban">
    <input type="text" name="usertounban" required placeholder="the name of the person u wanna unban"><br>
    <input type="submit" class="btn btn-info">
  </form>
<!--<details>
<summary><p>@everyone yo heres a funny meem i foun!11    1212'&^'Y7yjn</p></summary>
<video controls autoplay width="420">
<source src="https://cdn.discordapp.com/attachments/1009139630450425946/1014500028666089522/oh.mp4" type="video/mp4">
</video></details>--></center>
<?php
buildfooter();
?>