<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $args['pageTitle'] ?? $pageTitle ?? ''?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
    <nav class="navbar">
        <ul class="nav-left">
            <li><a class="logo" href="/index.php">Blog</a></li>
        </ul>
        <ul class="nav-rignt">
                    <?php if (!empty($_SESSION['user'])): ?>
                        <li>Bonjour, <?= ($_SESSION['user']['name']) ?>!</li>
                        <li> <a href="/ctrl/logout.php">Se déconnecter</a></li>
                    <?php else: ?>
                        <li> <a href="/ctrl/login-display.php">S'identifier</a></li>
                        <li> <a href="/ctrl/register-display.php">S'inscrire</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <li> <a href="/ctrl/article-add-display.php">Ajouter un article</a></li>
<?php endif; ?>
        </ul>
    </nav>
</header>

</body>
</html>