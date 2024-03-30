<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/core/function/siteconfig.php");
buildtop();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: /index.php");
    exit;
}
?>

<center><h1>Creating a game</h1>
<form method="post" action="/app/create/game/do">
    <label>Game name</label>
    <input type="text" name="gname" placeholder="Super Cool Epic Game!" required maxlength="95">

    <label>Game description</label>
    <textarea rows="5" cols="50" placeholder="This game is epic" name="gdescription" required maxlength="7100"></textarea>

    <label>IP Address</label>
    <input type="text" name="gip" placeholder="127.0.0.1" required>

    <label>Port</label>
    <input type="number" name="gport" placeholder="53640" required maxlength="5" max="65535"><br>

    <input type="submit" name="a" value="Create" class="btn btn-success btn-large">
</form>
</center>
<?php 
buildfooter(); 
?>