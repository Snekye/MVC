<form action="#" method="POST">

    <label for="username">Identifiant : </label>
    <input id="username" type="text" name="username" value="<?=isset($_POST['username']) ? $_POST['username'] : (isset($_COOKIE['username']) ? $_COOKIE['username'] : null) //Post > Cookie > Null ?>"><br>

    <label for="password">Mot de passe :</label>
    <input id="password" type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : null ?>"><br>

    <label for="password2">Confirmer mot de passe :</label>
    <input id="password2" type="password" name="password2" value="<?= isset($_POST['password2']) ? $_POST['password2'] : null ?>"><br>

    <button>Créer mon compte</button>

</form>
<?=$message?>