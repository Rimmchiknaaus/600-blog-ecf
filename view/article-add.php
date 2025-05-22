
<?php
$lang = $args['lang'];
$language = $args['language'];
?>

<h1><?= $language['article_add_title']; ?></h1>

<form action="/ctrl/article-add.php" method="post" enctype="multipart/form-data">
    <label for="lang"><?= $language['language']; ?></label><br>
    <select name="lang" id="lang" required>
        <option value="fr">Français</option>
        <option value="en">English</option>
    </select><br><br>

    <label for="titre"><?= $language['article_add_label_title']; ?></label><br>
    <input type="text" name="titre" id="titre" required><br><br>

    <label for="contenu"><?= $language['article_add_label_body']; ?></label><br>
    <div id="editor" style="height: 200px;"></div>
    <input type="hidden" name="contenu" id="contenuHidden"><br><br>

    <label for="image"><?= $language['article_add_label_image']; ?></label><br>
    <input type="file" name="image" id="image" accept="image/*"><br><br>

    <label for="fichier"><?= $language['article_add_label_file']; ?></label><br>
    <input type="file" name="fichier" id="fichier" accept=".pdf"><br><br>

    <label for="categories"><?= $language['article_add_label_cat']; ?></label><br>
    <?php foreach ($args['listCategorie'] as $cat): ?>
        <input type="checkbox" name="categories[]" value="<?= $cat['id'] ?>"
            <?= in_array($cat['id'], $args['articleCategorie'] ?? []) ? 'checked' : '' ?>>
        <?= htmlspecialchars($cat['label']) ?><br>
    <?php endforeach; ?>

    <button class="article-add" type="submit"><?= $language['article_add_button_send']; ?></button>
</form>



<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>


<script>
  const quill = new Quill('#editor', {
    theme: 'snow', 
  });

  const form = document.querySelector('form');
  form.addEventListener('submit', function () {
    const contenu = document.querySelector('#contenuHidden');
    contenu.value = quill.root.innerHTML;
  });
</script>
