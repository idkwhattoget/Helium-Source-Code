<?php


require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtoploggedout();

?>

	

<div class="app">
<h1>Create your account</h1>
<form action="/app/register/submit" method="post">
 <label>Username</label>
    <input type="text" name="username" placeholder="Username" required maxlength="20">
    <span class="help-block">This is what you will be known as!</span><br>
     <label>Password</label>
    <input type="password" name="pssword" placeholder="Password" required>
    <span class="help-block">Only you will know this!</span><br>
        <label>Confirm Password</label>
    <input type="password" name="conpssword" placeholder="Confirm Password" required>
    <span class="help-block">This is only here to check for typos.</span>
    <center>
<div class="g-recaptcha" data-sitekey="ur recaptcha site key goes here"></div>
</center>
<input type="submit" name="sıjasdas" class="btn btn-success btn-large" value="Register!">
</form>
</body>
</html>