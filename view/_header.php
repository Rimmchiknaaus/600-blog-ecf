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

    <header>
    <div class="layout">
    <nav class="navbar">
        <div class="nav-top">
            <li><a class="logo" href="/ctrl/task-list.php">ToDo</a></li>         
            <button class="burger" id="burger" aria-label="Ouvrir le menu"><span></span></button>    
        </div>

        <ul class="nav-right" id="navMenu">
                    <?php if (!empty($_SESSION['utilisateur'])): ?>
                        <li>Hello <?= ($_SESSION['utilisateur']['name']) ?>!</li>
                        <li> <a href="/ctrl/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="/ctrl/login-display.php">Login</a></li>
                        <li> <a href="/ctrl/register-display.php">Sign Up</a></li>
                    <?php endif; ?>
        </ul>
    </nav>
    <div class="layout">
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
<script src="https://kit.fontawesome.com/026a02d0be.js" crossorigin="anonymous"></script>
</body>
</html>