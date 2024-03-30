<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}
$otherstmt = $dbcon->prepare("SELECT isdiscordverified FROM users WHERE id = :uid");
$otherstmt->bindParam(":uid", $_SESSION['id'], PDO::PARAM_INT);
$otherstmt->execute();
$row = $otherstmt->fetch(PDO::FETCH_ASSOC);
if ($row['isdiscordverified'] !== 1) {
$randomnum = rand(0,6969420);
$jumbledmess = md5(sha1(base64_encode(md5(str_rot13($randomnum)))));
$verifycode1 = bin2hex($jumbledmess);
$verifycode2 = base64_encode($verifycode1);
$verifycode = substr(md5(sha1($verifycode2)), 0, 10);
try {
$stmt = $dbcon->prepare("UPDATE users SET discordverifycode = :dvcode WHERE id = :uid;");
$stmt->bindParam(":dvcode", $verifycode, PDO::PARAM_STR);
$stmt->bindParam(":uid", $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
} catch(PDOException $e) {
  die("A PDOException has occured:<br>".$e."<br><b><em>Please report this to the developers.</em></b>");
}
} elseif ($row['isdiscordverified'] == 1) {
    $stmt = $dbcon->prepare("UPDATE users SET discordverifycode = 'alreadyverified' WHERE id = :uid;");

$stmt->bindParam(":uid", $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
}
?>

<center><h1>u dont need this anymore</h1>
</center>

<?php 
buildfooter(); 
?>