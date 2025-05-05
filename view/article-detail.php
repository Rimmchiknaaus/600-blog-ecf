<main>
<section class="articles">

    <?php foreach ($args['article'] as $article) { ?>
        <div class="article-show">
    <h2><?= $article['titre'] ?></h2>
    <img class="article-image" src="<?= $article['image'] ?>" alt="Image de l'article">
    <div class="article-meta">
        <span class="article-date"><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></span>
        <span class="article-author">par <?= $article['auteur'] ?></span>
    </div>
    <p class="article-categories"><?= $article['categories'] ?></p>
    <p class="article-text"><?= $article['contenu'] ?></p>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <ul class="article-action">
            <li><a href="/article-update-display.php?id=<?= $article['id'] ?>" class="btn-article">Modifier</a></li>
            <li><a href="/article-delete.php?id=<?= $article['id'] ?>" class="btn-article">Supprimer</a></li>
        </ul>
    <?php endif; ?>
        </div>
    <?php } ?>
</section>
<section class="commentaires">
    <h3>Commentaires</h3>
    <?php if (!empty($commentaireList)): ?>
        <?php foreach ($commentaireList as $commentaire): ?>
            <div class="commentaire">
                <strong><?= $commentaire['auteur'] ?></strong>
                <em><?= date('d/m/Y H:i', strtotime($commentaire['created_at'])) ?></em>
                <p><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun commentaire pour l’instant.</p>
    <?php endif; ?>
</section>
</main>