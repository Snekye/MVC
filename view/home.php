<html>
    <?php require_once "head.php" ?>
    <link rel="stylesheet" href="public/css/home.css">

    <body>
        <section class="navbar">
            <p>Bienvenue, <?=$user->getUsername()?></p>
            <a href=<?=$prefix."/logout"?>>Déconnexion</a>
        </section>
        <section class="main">
            <p>Médias disponibles</p>
            <div class="medias">
                <?php
                foreach ($medias as $media) { ?>

                    <div class="media">
                        <p><?=$media->getTitle()?></p>
                        <p><?=$media->getAuthor()?></p>
                        <p><?=$media->getAvailable() ? 
                            "<span style='color:green'>Disponible</span>" : 
                            "<span style='color:red'>Non disponible</span>"
                        ?></p>
                        <form method="post" action=<?=$prefix."/edit"?>>
                            <input type="hidden" name="id" value="<?=$media->getId()?>">
                            <input type="hidden" name="media" value="<?=$media::class?>">
                            <button>Modifier</button>
                        </form>
                    </div>

                <?php }
                ?>
            </div>
        </section>
    </body>
</html>