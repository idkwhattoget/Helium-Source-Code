<?php

$_SESSION['page'] = "register";
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtoploggedout();

?>

	

<div class="app">
<h1>Before we start;</h1>
<p>Please make sure that you are not under 13.</p>
<p>If you are under 13, you cannot play this revival.</p>

<ul class="nav nav-pills" style="text-align: center !important;">
  <li class="active">
    <a href="/app/register/form">I am over 13</a>
  </li>
  <li><a href="https://google.com">I am not over 13</a></li>
</ul>

</div>
</body>
</html>