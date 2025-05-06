<h1>Nouvel article</h1>

<form action="/ctrl/article-add.php" method="post" enctype="multipart/form-data">
    <label for="titre">Titre :</label><br>
    <input type="text" name="titre" id="titre" required><br><br>

    <label for="contenu">Contenu :</label><br>
    <textarea name="contenu" id="contenu" rows="10" required></textarea><br><br>

    <label for="image">Image de l'article :</label><br>
    <input type="file" name="image" id="image" accept="image/*"><br><br>

    <label for="fichier">Fichier à télécharger (PDF) :</label><br>
    <input type="file" name="fichier" id="fichier" accept=".pdf"><br><br>

    <label for="categories">Catégories</label><br>
    <?php foreach ($args['listCategorie'] as $cat): ?>

        <input type="checkbox" name="categories[]" value="<?= $cat['id'] ?>"
            <?= in_array($cat['id'], $args['articleCategorie'] ?? []) ? 'checked' : '' ?>>
        <?= htmlspecialchars($cat['label']) ?>
        <br>
<?php endforeach; ?>


    <button type="submit">Publier</button>
</form>
