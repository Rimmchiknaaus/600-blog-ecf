<h1>Nouvel article</h1>

<form action="/ctrl/article-add.php" method="post" enctype="multipart/form-data">

    <label for="titre">Titre :</label><br>
    <input type="text" name="titre" id="titre" required><br><br>

    <label for="contenu">Contenu :</label><br>
    <div id="editor" style="height: 200px;"></div>
    <input type="hidden" name="contenu" id="contenuHidden"><br><br>

    <label for="image">Image de l'article :</label><br>
    <input type="file" name="image" id="image" accept="image/*"><br><br>

    <label for="fichier">Fichier à télécharger (PDF) :</label><br>
    <input type="file" name="fichier" id="fichier" accept=".pdf"><br><br>

    <label for="categories">Catégories</label><br>
    <?php foreach ($args['listCategorie'] as $cat): ?>
        <input type="checkbox" name="categories[]" value="<?= $cat['id'] ?>"
            <?= in_array($cat['id'], $args['articleCategorie'] ?? []) ? 'checked' : '' ?>>
        <?= htmlspecialchars($cat['label']) ?><br>
    <?php endforeach; ?>

    <button type="submit">Publier</button>
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
