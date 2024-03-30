<?php  
require_once("siteconfig.php");
if($_SERVER['REQUEST_METHOD'] !== "POST") {
  die("no get requests 👀");
}

    $recaptcha_secret = ""; // recaptcha secret goes here
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
    $response = json_decode($response, true);
     if($response["success"] !== true){
        echo "reCaptcha Verification Failed.";
        exit;
      }
// adjkhawıdurwejaıfjwkgı
function generateRandomString($length = 25)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
      }
$ticket = generateRandomString(32);
$gusername = $_POST['username'];
$gpassword = $_POST['pssword'];
$confirmedpassword = $_POST['conpssword'];
if (strlen($gusername) > 20) {
  die("Username cannot be longer than 20 characters!!");
}
  if (strlen($gusername) < 3) {
  die("username is too short lmfao");
}

if (empty($gusername) && !isset($gusername)) {
  die("Username cannot be empty!");
}

if (empty($gpassword) && !isset($gpasword)) {
  die("Password cannot be empty!");
}

if (empty($confirmedpassword) && !isset($confirmedpassword)) {
  die("You must confirm your password!!");
}
if (!preg_match("/^[a-zA-Z0-9_]+$/", $gusername)) {
  die("Username contains invalid characters!");
}


$hashedpass = password_hash($gpassword, PASSWORD_ARGON2ID);
$ipaddr = $_SERVER['REMOTE_ADDR'];  
$startingblurb = "Hi there!";

$isadminthing = 0;
// confirm password check

if ($gpassword !== $confirmedpassword) {
  die("Passwords didn't match!");
}

// end confirm password check

try {
  


  $getuserthingstmt = $dbcon->prepare("SELECT id FROM users WHERE username = :username");
  $getuserthingstmt->bindParam(':username', $gusername, PDO::PARAM_STR);
  $getuserthingstmt->execute();
  if($getuserthingstmt->rowCount() == 1) {
    die("That username is already taken!!");
  }
    $stmt = $dbcon->prepare("INSERT INTO users (username, password, isadmin, registerip, lastip, blurb, ticket)
  VALUES (:username, :password, :isadmin, :registerip, :lastip, :startblurb, :ticket)");
  $stmt->bindParam(':username', $gusername, PDO::PARAM_STR);
  $stmt->bindParam(':password', $hashedpass, PDO::PARAM_STR);
  $stmt->bindParam(':isadmin', $isadminthing, PDO::PARAM_INT);
  $stmt->bindParam(':registerip', $ipaddr, PDO::PARAM_STR);
  $stmt->bindParam(':lastip', $ipaddr, PDO::PARAM_STR);
  $stmt->bindParam(':startblurb', $startingblurb, PDO::PARAM_STR);
  $stmt->bindParam(':ticket', $ticket, PDO::PARAM_STR);
  $stmt->execute();
  header("Location: /app/login");
} catch(PDOException $e) {
  die("A PDOException has occured:<br>".$e."<br><b><em>Please report this to the developers.</em></b>");
}


?>