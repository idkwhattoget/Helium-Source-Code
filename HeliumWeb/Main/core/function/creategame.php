<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}

$gamename = $_POST['gname'];
$gamedesc = $_POST['gdescription'];
$gameip = $_POST['gip'];
$gameport = (int)$_POST['gport'];
//die($gameport.$gamename.$gamedesc.$gameip);

if(strlen($gamename) > 95) {
    die("game name too long");
}
if(strlen($gamedesc) > 7100) {
    die("game description too long");
}
if(!isset($gamename) || empty($gamename)) {
    die("game name cant be empty");
}
if(!isset($gamedesc) || empty($gamedesc)) {
    die("game description cant be empty");
}

if(!isset($gameip) || empty($gameip)) {
    die("game ip cant be empty");
}
if(!isset($gameport) || empty($gameport)) {
    die("game port cant be empty");
}

if(strlen($gameport) > 5) {
    die("invalid port");
}

if($gameport > 65535) {
    die("invalid port");
}

$stmt = $dbcon->prepare("INSERT INTO games (name, creatorname, description, ip, port)
VALUES (:gamename, :creator, :description, :ipaddr, :portnum);");
$stmt->bindParam(":gamename", $gamename, PDO::PARAM_STR);
$stmt->bindParam(":creator", $_SESSION['username'], PDO::PARAM_STR);
$stmt->bindParam(":description", $gamedesc, PDO::PARAM_STR);
$stmt->bindParam(":ipaddr", $gameip, PDO::PARAM_STR);
$stmt->bindParam(":portnum", $gameport, PDO::PARAM_INT);
$stmt->execute();
$otherstmtlol = $dbcon->prepare("SELECT id FROM games WHERE name = :gamenamelofmoa");
$otherstmtlol->bindParam(":gamenamelofmoa", $gamename, PDO::PARAM_STR);
$otherstmtlol->execute();
$row = $otherstmtlol->fetch(PDO::FETCH_ASSOC);
header("Location: /app/games/view?id=".$row['id']);
?>