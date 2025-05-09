<h1>Modifier article</h1>

<?php foreach($args['article'] as $article); ?>

<form action="/ctrl/article-update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">

    <label for="titre">Titre :</label><br>
    <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($article['titre']) ?>" required><br><br>

    <label for="contenu">Contenu :</label><br>
    <div id="editor"><?= $article['contenu'] ?></div>
    <input type="hidden" name="contenu" id="contenuHidden"><br><br>

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

    <button class="article-add " type="submit">Publier</button>
</form>

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>


<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });

  const form = document.querySelector('form');
  form.addEventListener('submit', function () {
    const contenu = document.querySelector('#contenuHidden');
    contenu.value = quill.root.innerHTML;
  });


</script>
