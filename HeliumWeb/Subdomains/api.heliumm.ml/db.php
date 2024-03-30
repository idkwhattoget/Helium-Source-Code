<?php
$servername = "localhost"; // your db shit here
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
?>