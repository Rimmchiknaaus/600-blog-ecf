
    <h2>Inscription</h2>
<?php if (!empty($_SESSION['msg'])): ?>
    <div>
        <?php foreach ($_SESSION['msg'] as $type => $message): ?>
            <p style="color: <?= $type === 'success' ? 'green' : 'red' ?>">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endforeach; ?>
        <?php unset($_SESSION['msg']); ?>
    </div>
<?php endif; ?>

<form method="POST" action="/ctrl/register.php">
    <label>Prénom :</label><br>
    <input type="text" name="myName" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="myEmail" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="myPassword" id="myPassword" required>
    <button type="button" onclick="togglePassword('myPassword')">👁</button><br><br>

    <label>Répéter le mot de passe :</label><br>
    <input type="password" name="myPasswordRepeat" id="myPasswordRepeat" required>
    <button type="button" onclick="togglePassword('myPasswordRepeat')">👁</button><br><br>

    <button type="submit">S'inscrire</button>
</form>

<script>
function togglePassword(id) {
    const field = document.getElementById(id);
    field.type = field.type === 'password' ? 'text' : 'password';
}
</script>



