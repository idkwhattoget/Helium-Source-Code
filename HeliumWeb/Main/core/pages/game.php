<?php 

require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}

$id = (int)$_GET['id'] ?? 1;
if (!isset($id)) {
  die("Invalid game.");
}
try {
  $stmt = $dbcon->prepare("SELECT * FROM games WHERE isprivate = 0 AND id = :gid");
  $stmt->bindParam(":gid", $id, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
  die("A PDOException has occured:<br>".$e."<br><b><em>Please report this to the developers.</em></b>");
}
?>

<style type="text/css">
  .gamecard {
    
     display: inline-block;
    margin-right: 20px;
    border-style: solid;
    margin-left: 10px;
    margin-bottom: 20px;
    border-radius: 10px;
    text-align: center;
    word-wrap: break-word !important;
  }

  .gtitle {
    
  }
  img {
    border-radius: 10px;
  }
  .playbtn {
    width: 110px;
  }
  
  .viewbtn {
    width: 100px;
  }
</style>
<center><h1><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
  <h2>by <?php echo htmlspecialchars($row['creatorname'], ENT_QUOTES, 'UTF-8'); ?></h2>
  <img src="<?php echo htmlspecialchars($row['thumbnail'], ENT_QUOTES, 'UTF-8'); ?>" width="560">
    <hr>
    <h1>Description</h1>
    <center><textarea readonly rows="5" cols="500" style="text-align:center;"><?php echo htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'); ?></textarea></center>
    <hr>
    <a href="/api/joingame.php?id=<?php echo htmlspecialchars($row['id'])?>" class="btn btn-success btn-large playbtn">Play!</a>
<?php 
buildfooter(); 
?>