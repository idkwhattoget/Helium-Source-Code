<?php
ob_start();
$id = (int)$_GET["id"];
$file = $id;
if (!file_exists($file)) {
    $file = "https://assetdelivery.roblox.com/v1/asset/?id=" . $id;
    header("location:" . $file);
}
readfile($file);
header("content-type:text/plain");

$data = ob_get_clean();
$signature;
$key = file_get_contents("../game/2013privatekey.pem");
openssl_sign($data, $signature, $key, OPENSSL_ALGO_SHA1);
echo sprintf("%%%s%%%s", base64_encode($signature), $data);
?>