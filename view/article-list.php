<?php
    $lang = $args['lang'];
    $language = $args['language'];
?>

<head>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<main>

<div class="filtre-categories">
    <?php foreach ($args['listCategorie'] as $c){ ?>
        <a href="/ctrl/article-list.php?categorie=<?= $c['id'] ?>&lang=<?= $lang ?>" class="filtre"><?= $c['label'] ?></a>
    <?php } ?>
    <a href="/ctrl/article-list.php?lang=<?= $lang ?>" class="filtre"><?= $language['categorie'] ?></a>
</div>

<section class="articles">
    <h1><?= $language['h1'] ?></h1>
    <div class="article-grid">
        <?php foreach ($args['listArticle'] as $article){ ?>
            <div class="article-card">
                <?php if (!empty($article['image'])): ?>
                    <img class="image" src="<?= $article['image'] ?>" alt="Image de l'article">
                <?php endif; ?>

                <div class="article-info">
                    <div class="article-meta">
                    <?php if ($article['updated_at']){ ?>
                        <em><span><?= $language['meta_update'] ?> </span><?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></em>
                    <?php } ?>

                    <?php if (!$article['updated_at']){ ?>
                        <em><span><?= $language['meta_create'] ?> </span><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></em>
                    <?php } ?>

                    <span class="article-author"><?= $language['meta_by'] ?> <?= $article['auteur'] ?></span>
                    </div>

                    <h2 class="titre"><?= $article['titre'] ?></h2>

                    <p class="article-categories"><?= $article['categories'] ?></p>
                    <p class="article-extrait"><?= substr(strip_tags($article['contenu'] ?? ''), 0, 150) ?>...</p>

                    <a href="/ctrl/article-detail.php?id=<?= $article['id'] ?>&lang=<?= $lang ?>" class="btn-detail"><?= $language['read'] ?></a>
                </div>
            </div>
        <?php } ?>
    </div>

    <?php if (empty($args['listArticle'])){ ?>
        <p><?= $language['no_article'] ?></p>
    <?php } ?>
</section>
</main>
