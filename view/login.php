<?php
$lang = $args['lang'];
$language = $args['language'];
?>
<h1><?= $language['connexion'] ?></h1>
        <form method="POST" action="/ctrl/login.php?lang=<?= $lang ?>">
            <input type="email" name="email" placeholder="<?= $language['placeholder_email'] ?>" required><br><br>
            <input type="password" name="password" placeholder="<?= $language['placeholder_password'] ?>" required><br><br>
            <button type="submit"><?= $language['login_btn'] ?></button><br><br>
            <span><?= $language['no_account'] ?> </span><button><a href="/ctrl/register-display.php?lang=<?= $lang ?>"><?= $language['signup_btn'] ?> </a></button>
        </form>



