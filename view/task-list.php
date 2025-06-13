<?php $editId = $_GET['edit'] ?? null; ?>

<section class="task-form">
<h2>Ajouter une tâche</h2>
<form action="/ctrl/task-add.php" method="post" enctype="multipart/form-data">
    <label>Nom de la tâche:<input type="text" name="name" required></label><br>
    <label>Description:<textarea name="description"></textarea></label><br>
    <label>Catégorie:
        <select name="idCategorie">
            <?php foreach ($args['listCategorie'] as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['label']) ?></option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Ajouter</button>
</form>
</section>
<hr>

<section class="task-list">

<h2>Liste des tâches</h2>
<ul>
    <?php foreach ($args['listTask'] as $task): ?>
        <?php if (isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['id'] == $task['idUtilisateur']){ ?>
        <li>
            <?php if ($editId == $task['id']): ?>
                <form action="/ctrl/task-update.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <input type="text" name="name" value="<?= htmlspecialchars($task['name'] ?? '') ?>"><br>
                    <textarea name="description"><?= htmlspecialchars($task['description'] ?? '') ?></textarea><br>
                    <select name="idCategorie">
                    <?php foreach ($args['listCategorie'] ?? [] as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $task['idCategorie'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['label']) ?>
                        </option>
                    <?php endforeach; ?>

                    </select><br>
                    <button type="submit">Mettre à jour</button>
                    <a href="/view/task-list.php">Annuler</a>
                </form>
            <?php else: ?>
                <strong><?= htmlspecialchars($task['name'] ?? '') ?></strong>
                (<?= htmlspecialchars($task['categorie'] ?? 'Catégorie inconnue') ?>)<br>
                <?= nl2br(htmlspecialchars($task['description'] ?? '')) ?><br>

                <section class="task-action">
                <a href="/ctrl/task-list.php?edit=<?= $task['id'] ?>">Modifier</a> |
                <a href="/ctrl/task-delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            <?php endif; ?>
        </li>
        <?php } ?>
    <?php endforeach; ?>
</ul>
</section>
