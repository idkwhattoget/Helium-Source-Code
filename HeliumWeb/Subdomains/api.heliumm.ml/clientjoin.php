<?php 

header("Content-type:text-plain");
$jscripturl = $_GET['jscripturl'] ?? "http://heliumm.ml/game/cannotconnect.php";
$authticket = $_GET['authticket'] ?? die('cannot get authticket');
$ip = $_GET['ip'] ?? "127.0.0.1";
$port = (int)$_GET['port'] ?? 53640;



?>
-a "http://www.heliumm.ml/" -j "<?php echo $jscripturl; ?>?authticket=<?php echo $authticket; ?>&port=<?php echo $port; ?>&ip=<?php echo $ip; ?>" -t "1"