<?php


$_SESSION['page'] = "login";
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtoploggedout();

?>

	

<div class="app">
<h1>Log in</h1>
<form action="/app/login/submit" method="post">
 <label>Username</label>
    <input type="text" name="username" placeholder="Username" required maxlength="20">
    <br>
     <label>Password</label>
    <input type="password" name="pssword" placeholder="Password" required>
    <br>
       
<input type="submit" name="sıjasdas" class="btn btn-info btn-large" value="Login!">
</form>
</body>
</html>