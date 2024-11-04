<form action="#" method="POST">

    <label for="username">Identifiant : </label>
    <input id="username" type="text" name="username" value="<?=isset($_POST['username']) ? $_POST['username'] : (isset($_COOKIE['username']) ? $_COOKIE['username'] : null) //Post > Cookie > Null ?>"><br>

    <label for="password">Mot de passe :</label>
    <input id="password" type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : null ?>"><br>

    <label for="remember">Se rappeler de moi</label>
    <input id="remember" type="checkbox" name="remember" <?=isset($_POST['username']) ? (isset($_POST['remember']) ? "checked" : "unchecked") : (isset($_COOKIE['username']) ? "checked" : "unchecked") //Post > Cookie ?>><br>

    <button>Connexion</button>

</form>
<?=$message?>