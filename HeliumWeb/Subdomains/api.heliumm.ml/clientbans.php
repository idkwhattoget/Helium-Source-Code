<?php
require_once($_SERVER['DOCUMENT_ROOT']."/db.php");
$stmt = $dbcon->prepare("SELECT username FROM users WHERE isclientbanned=1");
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
echo $row['username'];
}



?>