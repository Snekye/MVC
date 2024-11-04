<h3>Error <?=$error?></h3>
<p><?=$errorMessage?></p>

<?php
switch ($error) {
    case "403": ?>
        <a href=<?=$prefix."/login"?>>Log in</a>
        <a href=<?=$prefix."/register"?>>Sign in</a>
        <?php break;
    case "404": ?>
        <a href=<?=$prefix."/"?>>Back to main menu</a>
        <?php break;
}