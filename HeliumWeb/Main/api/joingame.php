<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
  $placeid = (int)$_GET['id'] ?? 0;
  $userstmt = $dbcon->prepare("SELECT * FROM users WHERE id=:uuid");
  $userstmt->bindParam(":uuid", $_SESSION['id'], PDO::PARAM_INT);
  $userstmt->execute();
  $userinfo = $userstmt->fetch(PDO::FETCH_ASSOC);
$auth = $userinfo['ticket'];
//{"joinscript":1,"authentication":1,"gameid":1}
$data= array(
    "auth" => $auth,
    "gameid" => $placeid
);
  $json1 = json_encode($data);
  $json = base64_encode($json1);
  
 // die(print_r($data).$json.$json1);
header("Location: helium://".$json);

?>