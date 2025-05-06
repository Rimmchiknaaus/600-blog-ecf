<main>
<section class="articles">
    <?php foreach ($args['articleList'] as $article) { ?>
        <div class="article-show">
    <h2><?= $article['titre'] ?></h2>
    <img class="article-image" src="<?= $article['image'] ?>" alt="Image de l'article">
    <div class="article-meta">
        <?php if ($article['updated_at']):?>
            <em><span>updated at </span><?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></em>
        <?php else: ?>
            <em><span></span><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></em>
        <?php endif; ?>
        <span class="article-author">par <?= $article['auteur'] ?></span>
    </div>
    <p class="article-categories"><?= $article['categories'] ?></p>
    <p class="article-text"><?= $article['contenu'] ?></p>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'){ ?>
        <ul class="article-action">
            <li><a href="/ctrl/article-update-display.php?id=<?= $article['id'] ?>" class="btn-article">Modifier</a></li>
            <li><a href="/ctrl/article-delete.php?id=<?= $article['id'] ?>" class="btn-article">Supprimer</a></li>
        </ul>
        <?php } ?>
        </div>
    <?php } ?>
</section>
<section class="commentaire-form">
    <h3>Ajouter un commentaire</h3>
    <?php if (!empty($_SESSION['user'])): ?>
        <form action="/ctrl/commentaire-add.php" method="post">
            <input type="hidden" name="idArticle" value="<?= $_GET['id'] ?>">
            <textarea name="contenu" rows="4" required placeholder="Votre commentaire..."></textarea><br><br>
            <button type="submit">Envoyer</button>
        </form>
    <?php else: ?>
        <p>Vous devez être connecté pour laisser un commentaire.</p>
        <a class="btn-commentaire"  href="/ctrl/login-display.php" class="btn-article">Se connecter</a>
        <?php endif ?>
</section>
<section class="commentaires">
    <h3>Commentaires</h3>
    <?php $editCommentId = $_GET['editCommentaire'] ?? null; ?>
        <?php foreach ($args['commentaireList'] as $commentaire){ ?>
            <div class="commentaire">
                <strong><?= $commentaire['auteur'] ?></strong>
                <?php if ($commentaire['updated_at']):?>
                <em><span>updated at </span><?= date('d/m/Y H:i', strtotime($commentaire['updated_at'])) ?></em>
                <?php else: ?>
                <em><span></span><?= date('d/m/Y H:i', strtotime($commentaire['created_at'])) ?></em>
                <?php endif; ?>
                <?php if ($editCommentId == $commentaire['id']): ?>

                   <form action="/ctrl/commentaire-update.php" method="post">
                     <input type="hidden" name="id" value="<?= $commentaire['id'] ?>">
                     <input type="hidden" name="idArticle" value="<?= $_GET['id'] ?>">
                     <textarea name="contenu" rows="4" required><?= htmlspecialchars($commentaire['contenu']) ?></textarea><br>
                     <button  type="submit">Enregistrer</button>
                     <a href="/ctrl/article-detail.php?id=<?= $_GET['id'] ?>">Annuler</a>
                   </form>
                <?php else: ?>
                    <p><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></p>
               <?php endif; ?>
            <div class="commentaire-actions">
            <?php if (isset($_SESSION['user']) &&( $_SESSION['user']['id'] == $commentaire['idUser'] )){ ?>
                <a href="/ctrl/article-detail.php?id=<?= $_GET['id'] ?>&editCommentaire=<?= $commentaire['id'] ?>" class="btn-commentaire">Modifier</a>
                <?php } ?>
                <?php if (isset($_SESSION['user']) &&( $_SESSION['user']['id'] == $commentaire['idUser'] ||$_SESSION['user']['role'] === 'admin')){ ?>
                <a href="/ctrl/commentaire-delete.php?id=<?= $commentaire['id'] ?>&idArticle=<?= $commentaire['idArticle'] ?>" class="btn-commentaire" onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</a>
                <?php } ?>
            </div>
            </div>
        <?php } ?>
        <?php if (empty($commentaire)){ ?>
            <p>Pas de commentaires</p>
        <?php } ?>
</section>
</main>