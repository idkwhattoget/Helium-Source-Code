<?php 
require_once("db.php");
$placeid = (int)$_GET['placeid'] ?? null;
if (!isset($placeid)) {
	$placeid = null;
}

$stmt = $dbcon->prepare("SELECT ip,port FROM games WHERE id = :gid");
$stmt->bindParam(":gid", $placeid, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode($row);

?>