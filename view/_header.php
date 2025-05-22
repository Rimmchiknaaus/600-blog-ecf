<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $args['pageTitle'] ?? $pageTitle ?? ''?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/view/lang/lang-init.php'; ?>
    <header>
    <nav class="navbar">
        <div class="nav-top">
            <li><a class="logo" href="/ctrl/article-list.php?lang=<?= $lang ?>"><?=$language['site']?></a></li>         
            <button class="burger" id="burger" aria-label="Ouvrir le menu"><span></span></button>    
        </div>

        <ul class="nav-right" id="navMenu">
                    <?php if (!empty($_SESSION['user'])): ?>
                        <li><?=$language['hello']?><?= ($_SESSION['user']['name']) ?>!</li>
                        <li> <a href="/ctrl/logout.php?lang=<?= $lang ?>"><?=$language['logout']?></a></li>
                    <?php else: ?>
                        <li><a href="/ctrl/login-display.php?lang=<?= $lang ?>"><?= $language['login'] ?></a></li>
                        <li> <a href="/ctrl/register-display.php?lang=<?= $lang ?>"><?=$language['signup']?></a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <li> <a href="/ctrl/article-add-display.php?lang=<?= $lang ?>"><?=$language['add_article']?></a></li>
                    <?php endif; ?>
                    <li><div class="language-link">
    <a class="language-link-item" href="/ctrl/article-list.php?lang=en"
        <?php if($lang == 'en'){?> style="color: #ff9900;" <?php } ?>>EN</a> | 
    <a class="language-link-item" href="/ctrl/article-list.php?lang=fr"
        <?php if($lang == 'fr'){?> style="color: #ff9900;" <?php } ?>>FR</a>    
</div> </li>
        </ul>
    </nav>
</header>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const burger = document.getElementById('burger');
    const navMenu = document.getElementById('navMenu');

    burger.addEventListener('click', function () {
        navMenu.classList.toggle('show');
        burger.classList.toggle('hidden');
    });
});
</script>

</body>
</html>