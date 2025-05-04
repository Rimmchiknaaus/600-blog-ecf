<main>
<?php
$listArticle = $args['listArticle'] ?? [];
$session = $args['session'] ?? [];
?>
<?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
    <a href="/ctrl/article-add-display.php">Ajouter une article</a>
<?php endif; ?>
<section class="articles">
    <h1>Derniers articles</h1>
    <?php if (!empty($listArticle)): ?>
        <div class="article-grid">
            <?php foreach ($args ['listArticle'] as $article): ?>
                <div class="article-card">
                    <?php if (!empty($article['image'])): ?>
                        <img src="<?= $article['image'] ?>" alt="Image de l'article">
                    <?php endif; ?>

                    <div class="article-meta">
                        <span class="article-date"><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></span>
                        <span class="article-author">par <?= $article['auteur'] ?></span>
                    </div>

                    <h2><?= $article['titre'] ?></h2>

                    <p class="article-categories">
                        <?= $article['categories'] ?>
                    </p>

                    <p class="article-extrait">
                        <?= substr(strip_tags($article['contenu']), 0, 150) ?>...
                    </p>

                    <a href="/article-detail.php?id=<?= $article['id'] ?>" class="btn">Lire la suite</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun article trouvé.</p>
    <?php endif; ?>
</section>
   <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla commodi consequuntur architecto quaerat odio nihil autem asperiores maxime perferendis quisquam repudiandae quis, voluptate quam sit veritatis porro. Eum, ipsam incidunt?</p>
</main>