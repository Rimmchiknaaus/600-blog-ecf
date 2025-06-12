<h2>Ajouter une tâche</h2>
<form action="/ctrl/task-add.php" method="post" enctype="multipart/form-data">
    <label>Nom de la tâche:
        <input type="text" name="name" required>
    </label><br>
    <label>Description:
        <textarea name="description"></textarea>
    </label><br>
    <label>Catégorie:
        <select name="idCategorie">
            <?php foreach ($args['listCategorie'] as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['label']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Ajouter</button>
</form>

<hr>

<h2>Liste des tâches</h2>
    <ul>
        <?php foreach ( $args['listTask'] as $task){ ?>
            <li>
                <?php if ($editId == $task['id']): ?>
                    <form action="/ctrl/task.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_id" value="<?= $task['id'] ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($task['name']) ?>"><br>
                        <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea><br>
                        <select name="idCategorie">
                            <?php foreach ($args['listCategorie'] as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= $cat['id'] == $task['idCategorie'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['label']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br>
                        <button type="submit">Mettre à jour</button>
                        <a href="index.php">Annuler</a>
                    </form>
                <?php else: ?>
                    <strong><?= htmlspecialchars($task['name']) ?></strong>
                    (<?= htmlspecialchars($task['categorie']) ?>)<br>
                    <?= nl2br(htmlspecialchars($task['description'])) ?><br>
                    <a href="/ctrl/task-update.php?id=<?= $task['id'] ?>&edit=<?= $task['id'] ?>">Modifier</a> |
                    <a href="/ctrl/task-delete.php?id=<?= $task['id'] ?>">Supprimer</a>
                <?php endif; ?>
            </li>
            <?php } ?>
    </ul>


