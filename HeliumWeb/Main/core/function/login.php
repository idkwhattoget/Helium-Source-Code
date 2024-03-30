<?php 
/* super epic login thing made by my uncle have credit
i just converted it into pdo (it was originally in mysqli)

modified for aspxblox!1!1!!1!!!!!

*/

require_once("siteconfig.php");

try {

	$gusername = $_POST["username"];
	$gpassword =$_POST["pssword"];
	if (empty($gusername) && !isset($gusername)) {
  die("You must enter your username!");
}

if (empty($gpassword) && !isset($gpasword)) {
  die("You must enter your password!");
}
	  
 	 $stmt = $dbcon->prepare("SELECT * FROM users WHERE username = :username");
	$stmt->bindParam(':username', $gusername);
	
	
	
	$doquerything = $stmt->execute();
	$q = $stmt->rowCount();
	if($q>0){

		$getrow = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if(password_verify($gpassword,$getrow['password'])){
			$_SESSION["id"]=$getrow["id"];
			$_SESSION["username"]=$getrow["username"];
			$_SESSION["loggedin"] = true;
			header("location: /app/home");
		}else{
			die("Incorrect username or password.");
		}
		
	}else{
		die("Incorrect username or password.");
	}

} catch(PDOException $e) {
 die("A PDOException has occured:<br>".$e."<br><b><em>Please report this to the developers.</em></b>");
}




 ?>