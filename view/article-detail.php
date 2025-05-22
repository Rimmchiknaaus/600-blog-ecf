<?php
$lang = $args['lang'];
$language = $args['language'];
$article = $args['article'];
?>

<main>
<section class="articles">

        <div class="article-show">
            <h2><?= $article['titre'] ?></h2>
            <img class="article-image" src="<?= $article['image'] ?>" alt="Image de l'article">
            <div class="article-meta">
                <?php if ($article['updated_at']){ ?>
                    <em><span><?= $language['article_detail_updated'] ?> </span><?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></em>
                <?php } ?>
                <?php if (!$article['updated_at']){ ?>
                    <em><span></span><?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></em>
                <?php } ?>
                <span class="article-author"><?= $language['article_detail_by'] ?> <?= $article['auteur'] ?></span>
            </div>
            <p class="article-categories"><?= $article['categories'] ?></p>
            <p class="article-text"><?= $article['contenu'] ?></p>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'){ ?>
                <ul class="article-action">
                    <li><a href="/ctrl/article-update-display.php?id=<?= $article['id']?>&lang=<?= $lang ?>" class="btn-article"><?= $language['btn_edit'] ?></a></li>
                    <li><a href="/ctrl/article-delete.php?id=<?= $article['id'] ?>&lang=<?= $lang ?>" class="btn-article"><?= $language['btn_delete'] ?></a></li>
                </ul>
            <?php } ?>
        </div>
</section>

<section class="commentaire-form">
    <h3><?= $language['comment_add_title'] ?></h3>
    <?php if (!empty($_SESSION['user'])): ?>
        <form action="/ctrl/commentaire-add.php?lang=<?= $lang ?>" method="post">
            <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
            <input type="hidden" name="idArticle" value="<?= $_GET['id'] ?>">
            <textarea name="contenu" rows="4" required placeholder="<?= $language['comment_placeholder'] ?>"></textarea><br><br>
            <button type="submit"><?= $language['btn_send'] ?></button>
        </form>
    <?php else: ?>
        <p><?= $language['comment_auth_required'] ?></p>
        <a class="btn-commentaire" href="/ctrl/login-display.php?lang=<?= $lang ?>"><?= $language['btn_login'] ?></a>
    <?php endif ?>
</section>

<section class="commentaires">
    <h3><?= $language['comment_list_title'] ?></h3>
    <?php $editCommentId = $_GET['editCommentaire'] ?? null; ?>
    <?php foreach ($args['commentaireList'] as $commentaire){ ?>
        <div class="commentaire">
            <strong><?= $commentaire['auteur'] ?></strong>
            <?php if ($commentaire['updated_at']){ ?>
                <em><span><?= $language['article_detail_updated'] ?> </span><?= date('d/m/Y H:i', strtotime($commentaire['updated_at'])) ?></em>
            <?php } ?>
            <?php if (!$commentaire['updated_at']){ ?>
                <em><span></span><?= date('d/m/Y H:i', strtotime($commentaire['created_at'])) ?></em>
            <?php } ?>

            <?php if ($editCommentId == $commentaire['id']){ ?>
                <form action="/ctrl/commentaire-update.php" method="post">
                    <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
                    <input type="hidden" name="id" value="<?= $commentaire['id'] ?>">
                    <input type="hidden" name="idArticle" value="<?= $_GET['id'] ?>">
                    <textarea name="contenu" rows="4" required><?= htmlspecialchars($commentaire['contenu']) ?></textarea><br>
                    <button type="submit"><?= $language['btn_save'] ?></button>
                    <button type="submit"><a href="/ctrl/article-detail.php?id=<?= $_GET['id'] ?>&lang=<?= $lang ?>"><?= $language['btn_cancel'] ?></a></button>
                </form>
            <?php } ?>
            <?php if ($editCommentId != $commentaire['id']){ ?>
                <p><?= nl2br(htmlspecialchars($commentaire['contenu'])) ?></p>
            <?php } ?>

            <div class="commentaire-actions">
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $commentaire['idUser']){ ?>
                    <a href="/ctrl/article-detail.php?id=<?= $_GET['id'] ?>&editCommentaire=<?= $commentaire['id'] ?>&lang=<?= $lang ?>" class="btn-commentaire"><?= $language['btn_edit'] ?></a>
                <?php } ?>
                <?php if (isset($_SESSION['user']) && ($_SESSION['user']['id'] == $commentaire['idUser'] || $_SESSION['user']['role'] === 'admin')){ ?>
                    <a href="/ctrl/commentaire-delete.php?id=<?= $commentaire['id'] ?>&idArticle=<?= $commentaire['idArticle'] ?>&lang=<?= $lang ?>" class="btn-commentaire" onclick="return confirm('<?= $language['comment_delete_confirm'] ?>')"><?= $language['btn_delete'] ?></a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <?php if (empty($args['commentaireList'])){ ?>
        <p><?= $language['comment_none'] ?></p>
    <?php } ?>
</section>
</main>
