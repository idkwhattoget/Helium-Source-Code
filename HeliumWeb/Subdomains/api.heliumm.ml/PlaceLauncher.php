<?php
  die("trolled by jason voorhees.");
require_once("db.php");
$id = (int)$_GET['id'];

$stmt = $dbcon->prepare("SELECT * FROM game_join_requests WHERE id = :gid");
$stmt->bindParam(":gid", $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$joinurl = $row['jsurl'];
$authticket = $row['authTicket'];
$placeid = (int)$row['placeid'];
if ($stmt->rowCount() == 0) {
  $joinurl = "http://heliumm.ml/game/cannotconnect.php";
$authticket = "idk";
$placeid = 0;
}
$info = array(
  "joinScriptUrl" => $joinurl,
  "authTicket" => $authticket,
  "placeid" => $placeid
);

$jsondata = json_encode($info);
echo $jsondata;


?>