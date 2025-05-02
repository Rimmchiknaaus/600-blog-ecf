<h1>Nouvel article</h1>

<form action="" method="post" enctype="multipart/form-data">
    <label for="titre">Titre :</label><br>
    <input type="text" name="titre" id="titre" required><br><br>

    <label for="contenu">Contenu :</label><br>
    <textarea name="contenu" id="contenu" rows="10" required></textarea><br><br>

    <label for="image">Image de l'article :</label><br>
    <input type="file" name="image" id="image" accept="image/*"><br><br>

    <label for="fichier">Fichier à télécharger (PDF) :</label><br>
    <input type="file" name="fichier" id="fichier" accept=".pdf"><br><br>

    <label for="categories">Catégories :</label><br>
    <div>
            <label for="categories">Catégories</label>
            <select name="categories">
                <?php foreach ($listCategorie as $cat) { ?>
                    <option value="<?= $cat['id'] ?>">#<?= $cat['label'] ?></option>
                <?php } ?>
            </select>
        </div>

    <button type="submit">Publier</button>
</form>
