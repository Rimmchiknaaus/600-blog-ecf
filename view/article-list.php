
<head>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<main>
<div class="language-link">
<?php require $_SERVER['DOCUMENT_ROOT'] . '/view/lang/lang-init.php'; ?>

        <a class="language-link-item" href="/ctrl/article-list.php?lang=en"
            <?php if($lang == 'en'){?> style="color: #ff9900;"
            <?php } ?>>English</a> | <a class="language-link-item"
            href="/ctrl/article-list.php?lang=fr" <?php if($lang == 'fr'){?>
            style="color: #ff9900;" <?php } ?>>Français</a>    
    </div>    
<div class="filtre-categories">
<?php foreach ($args ['listCategorie'] as $c){ ?>
    <a href="/ctrl/article-list.php?categorie=<?= $c['id'] ?>" class="filtre"><?=$c['label']?></a>
    <?php } ?>
    <a href="/ctrl/article-list.php" class="filtre"><?=$language['categorie']?></a>
</div>

<section class="articles">
    <h1><?= $language['h1'] ?></h1>
        <div class="article-grid">
            <?php foreach ($args ['listArticle'] as $article){ ?>
                <div class="article-card">
                    <?php if (!empty($article['image'])): ?>
                        <img class="image" src="<?= $article['image'] ?>" alt="Image de l'article">
                    <?php endif; ?>
                        <div class="article-info">
                    <div class="article-meta">
                    <?php if ($article['updated_at']):?>
                        <em><span><?=$language['meta_update']?> </span><?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></em>
                    <?php else: ?>
                        <em><span><?=$language['meta_create']?></span><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></em>
                    <?php endif; ?>
                        <span class="article-author"><?=$language['meta_by']?> <?= $article['auteur'] ?></span>
                    </div>

                    <h2 class="titre" ><?= $article [$lang.'titre'] ?></h2>

                    <p class="article-categories">
                        <?= $article['categories'] ?>
                    </p>

                    <p class="article-extrait">
                        <?= substr(strip_tags($article[$lang.'contenu']), 0, 150) ?>...
                    </p>

                    <a href="/ctrl/article-detail.php?id=<?= $article['id'] ?>" class="btn-detail"><?=$language['read']?></a>
                    </div>
                </div>
        <?php } ?>
        </div>
        <?php if (empty($article)){ ?>
            <p><?=$language['no_article']?></p>
        <?php } ?>
</section>
</main>