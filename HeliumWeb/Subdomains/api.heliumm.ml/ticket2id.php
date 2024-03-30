<?php 
require_once("db.php");
$ticket = $_GET['ticket'] ?? null;
if (!isset($ticket)) {
	$ticket = null;
}

$stmt = $dbcon->prepare("SELECT username FROM users WHERE ticket = :ticket");
$stmt->bindParam(":ticket", $ticket, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['username'] == "NULL") {
	$row['username'] == "brah";
}
echo $row['username'];

?>