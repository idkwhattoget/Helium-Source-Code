<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /app/home");
    exit;
}?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Helium</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
  <style type="text/css">
    .bg-video {
      position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1233123345234534652476567586;
    }
    .app {
      z-index: 1;
      color: rgb(255, 255, 255);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-weight: lighter !important;
      text-align: center;
    }
  </style>
  <script type="text/javascript">
    window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#h';
        window.location.reload();
    }
}
  </script>
</head>
<body>
<!--<div class="navbar navbar-inverse navbar-static-top">
  <div class="navbar-inner">
    <a class="brand active" href="/">Helium</a>
    <ul class="nav">
      <li><a href="/app/register">Register</a></li>
      <li><a href="/app/login">Login</a></li>
      <li><a href="https://discord.gg/acCZ2QBFtE">Discord</a></li>
    </ul>
  </div>
</div>-->
<video class="bg-video" autoplay loop muted>
  <source src="/video/bg-video.mp4" type="video/mp4">
</video> 
<div class="app">
<h1>Welcome to Helium</h1>
<p>Helium is one of those "old roblox revivals".</p>
<a href="/app/register" class="btn btn-success btn-large">Register</a>&nbsp;<a href="/app/login" class="btn btn-info btn-large">Login</a>
</div>
</body>
</html>