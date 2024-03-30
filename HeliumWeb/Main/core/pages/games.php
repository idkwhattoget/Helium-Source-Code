<?php 

require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}

$loadnum = (int)$_GET['load'] ?? 10;
if (!isset($loadnum)) {
  $loadnum = (int)10;
}
$moregames = $loadnum + (int)10;
$lessgames = $loadnum - (int)10;
if ($loadnum < (int)1) {
    header("Location: /app/games?load=10");
  }
?>

<style type="text/css">
  .gamecard {
    
    display: inline-block;
    margin-right: 20px;
    border-style: solid;
    margin-left: 5px;
    margin-bottom: 20px;

    text-align: center;
    word-wrap: break-word !important;
  }

  .gtitle {
    
  }
  img {
    border-radius: 10px;
    width: 300px;
    text-align:center;
  }
  .playbtn {
    width: 110px;
  }
  
  .viewbtn {
    width: 100px;
  }
  .btn-noround {
    border-radius: 0px !important;
    }
</style>
<center><h1>Helium games</h1>
  <?php
  try {
  $stmt = $dbcon->prepare("SELECT * FROM games WHERE isprivate=0 ORDER BY `created` DESC LIMIT :numtoload ");
  $stmt->bindParam(":numtoload", $loadnum, PDO::PARAM_INT); 
  $stmt->execute();
  $otherstmt = $dbcon->prepare("SELECT * FROM games WHERE isprivate = 0 ");
  $otherstmt->execute();
  $q = $stmt->rowCount();
  $otherq = $otherstmt->rowCount();
  if ($q<1) {
    echo "<p>There are no games currently being hosted</p>";
  }
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $gname = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
    echo '<div class="gamecard"><img src="'.htmlspecialchars($row['thumbnail'], ENT_QUOTES, 'UTF-8').'" width="300" height="100" style="height: 200px; border-radius: 0 !important;"><h3 class="gtitle">'.substr($gname, 0, 18).'</h3><a href="/api/joingame.php?id='.htmlspecialchars($row['id']).'" class="btn btn-success btn-large playbtn btn-noround">Play</a><a href="/app/games/view?id='.htmlspecialchars($row['id']).'" class="btn btn-primary btn-large playbtn btn-noround" >View</a></div>';
  }
} catch(PDOException $e) {
  die("A PDOException has occured:<br>".$e."<br><b><em>Please report this to the developers.</em></b>");
} 
// <p>game1</p></center>
  if($q>1) {
if ($otherq>10) {
    echo "<br><a href='?load=".$moregames."'>Show 10 fucking more games</a>";
    echo "<br><a href='?load=3423423423423423'>Show all games lmao</a>";
  }
  if ($otherq>12) {
    echo "<br><a href='?load=".$lessgames."'>Show 10 fucking less games</a>";
    echo "<br><a href='?load=10'>Show 10 games</a>";
    
  }
  
}
?>
<?php 
buildfooter(); 
?>