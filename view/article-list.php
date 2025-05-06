<head>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<main>


<section class="articles">
    <h1>Derniers articles</h1>
        <div class="article-grid">
            <?php foreach ($args ['listArticle'] as $article){ ?>
                <div class="article-card">
                    <?php if (!empty($article['image'])): ?>
                        <img class="image" src="<?= $article['image'] ?>" alt="Image de l'article">
                    <?php endif; ?>
                        <div class="article-info">
                    <div class="article-meta">
                    <?php if ($article['updated_at']):?>
                        <em><span>updated at </span><?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></em>
                    <?php else: ?>
                        <em><span></span><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></em>
                    <?php endif; ?>
                        <span class="article-author">par <?= $article['auteur'] ?></span>
                    </div>

                    <h2><?= $article['titre'] ?></h2>

                    <p class="article-categories">
                        <?= $article['categories'] ?>
                    </p>

                    <p class="article-extrait">
                        <?= substr(strip_tags($article['contenu']), 0, 150) ?>...
                    </p>

                    <a href="/ctrl/article-detail.php?id=<?= $article['id'] ?>" class="btn-detail">Lire la suite</a>
                    </div>
                </div>
        <?php } ?>
        </div>
        <?php if (empty($article)){ ?>
            <p>Aucun article trouvé.</p>
        <?php } ?>
</section>
   <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla commodi consequuntur architecto quaerat odio nihil autem asperiores maxime perferendis quisquam repudiandae quis, voluptate quam sit veritatis porro. Eum, ipsam incidunt?</p>
</main>