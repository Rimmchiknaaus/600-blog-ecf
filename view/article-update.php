<h1>Modifier article</h1>

<?php foreach($args['article'] as $article); ?>

<form action="/ctrl/article-update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">

    <label for="titre">Titre :</label><br>
    <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($article['titre']) ?>" required><br><br>

    <label for="contenu">Contenu :</label><br>
    <textarea name="contenu" id="contenu" rows="10" required><?= htmlspecialchars($article['contenu']) ?></textarea><br><br>

    <label for="image">Image de l'article :</label><br>
    <input type="file" name="image" id="image" accept="image/*"><br>
    <?php if (!empty($article['image'])): ?>
        <p><img src="<?= htmlspecialchars($article['image']) ?>" width="200"></p>
    <?php endif; ?>
    <br>
    

    <label for="fichier">Fichier à télécharger (PDF) :</label><br>
    <input type="file" name="fichier" id="fichier" accept=".pdf"><br><br>

    <?php foreach ($args['listCategorie'] as $cat): ?>
    <label>
        <input type="checkbox" name="categories[]" value="<?= $cat['id'] ?>"
            <?= in_array($cat['id'], $args['articleCategorie'] ?? []) ? 'checked' : '' ?>>
        <?= htmlspecialchars($cat['label']) ?>
    </label><br>
<?php endforeach; ?>

    <button type="submit">Publier</button>
</form>
