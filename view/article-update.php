<?php
$lang = $args['lang'];
$language = $args['language'];
$article = $args['article'];
$titre = $article['titre'] ?? '';
?>

<h1><?= $language['article_edit_title']; ?></h1>

<form action="/ctrl/article-update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
    <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">

    <label for="titre"><?= $language['article_edit_label_title']; ?></label><br>
    <input type="text" name="titre" value="<?= htmlspecialchars($titre) ?>">

    <label for="contenu"><?= $language['article_edit_label_body']; ?></label><br>
    <div id="editor"><?= $article['contenu']?></div>
    <input type="hidden" name="contenu" id="contenuHidden"><br><br>

    <label for="image"><?= $language['article_edit_label_image']; ?></label><br>
    <input type="file" name="image" id="image" accept="image/*"><br>
    <?php if (!empty($article['image'])): ?>
        <p><img src="<?= htmlspecialchars($article['image']) ?>" width="200"></p>
    <?php endif; ?>
    <br>

    <label for="fichier"><?= $language['article_edit_label_file']; ?></label><br>
    <input type="file" name="fichier" id="fichier" accept=".pdf"><br><br>

    <?php foreach ($args['listCategorie'] as $cat): ?>
        <label>
            <input type="checkbox" name="categories[]" value="<?= $cat['id'] ?>"
                <?= in_array($cat['id'], $args['articleCategorie'] ?? []) ? 'checked' : '' ?>>
            <?= htmlspecialchars($cat['label']) ?>
        </label><br>
    <?php endforeach; ?>

    <button class="article-add" type="submit"><?= $language['article_edit_button_submit']; ?></button>
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
