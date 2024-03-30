<?php
session_name("HELIUM_AUTHENTICATION");
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "m30354_heliumdb";
try {
  $dbcon = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
  // set the PDO error mode to exception
  $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbcon->setAttribute(PDO::ATTR_PERSISTENT , true);
      } catch(PDOException $e) {
        die("A PDOException has occured:<br>".$e."<br><b><em>Please report this to the developers.</em></b>");
      }

$stmtban = $dbcon->prepare("SELECT isclientbanned FROM users WHERE username=:leusername");
 $stmtban->bindParam(":leusername", $_SESSION['username'], PDO::PARAM_STR);
  $stmtban->execute();
$row1231234 = $stmtban->fetch(PDO::FETCH_ASSOC);
if ($row1231234['isclientbanned'] == 1)  {
     die("ur banned cringe<br>to logout, go to /app/logout");
     
  }


function buildtoploggedout() {
  echo '<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Helium</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <style type="text/css">
    
    .app {
      z-index: 1;
      
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-weight: lighter !important;
      text-align: center;
    }
  </style>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <meta property="og:title" content="Helium" />
  <meta property="og:description" content="Helium, helious, hellium, helium revived, whatever u wanna call it" />
  <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhy1U4YwvOKQvWSMQV9ZqyGO2lOep33EMcbw&usqp=CAU" />
  <meta name="theme-color" content="#00ff4c">
</head>
<body>';
  
    echo '<div class="navbar navbar-inverse navbar-static-top">
  <div class="navbar-inner">
    <a class="brand active" href="/">Helium</a>
    <ul class="nav">
      <li><a href="/app/register">Register</a></li>
      <li><a href="/app/login">Login</a></li>
      <li><a href="https://discord.gg/acCZ2QBFtE">Discord</a></li>
    </ul>
  </div>
</div>
  ';
  
  
}
function buildtop() {
  echo '<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Helium</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <style type="text/css">
    
    .app {
      z-index: 1;
      
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-weight: lighter !important;
      text-align: center;
    }
  </style>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <meta property="og:title" content="Helium" />
  <meta property="og:description" content="Helium, helious, hellium, helium revived, whatever u wanna call it" />
  <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQhy1U4YwvOKQvWSMQV9ZqyGO2lOep33EMcbw&usqp=CAU" />
  <meta name="theme-color" content="#00ff4c">
</head>
<body>';
 echo '<div class="navbar navbar-inverse navbar-static-top">
  <div class="navbar-inner">
    <a class="brand active" href="/">Helium</a>
    <ul class="nav">
      <li><a href="/">Home</a></li>
      <li><a href="/app/games">Games</a></li>
      <li><a href="/app/create">Create</a></li>
      <li><a href="/app/users">Users</a></li>

      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="https://discord.gg/acCZ2QBFtE">Discord</a></li>
                        <li><a href="/app/discord/verify">Get Discord Verification Code</a></li>
                          
                          <li class="divider"></li>
                          <li class="text-error"><a href="/app/logout" >Logout</a></li>
                          
                        </ul>
                      </li>
    </ul>
  </div>
</div>

  ';
  }


function buildfooter() {
  echo'
  <center>
  <hr>
  <p>'.date("Y").' Helium<br>we are non profit</p>
  </center>
   <script src="https://code.jquery.com/jquery-1.9.1.js"></script>

 <script src="/js/bootstrap.js"></script>
</body>
</html>';
}



?>