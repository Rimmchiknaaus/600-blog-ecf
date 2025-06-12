<h1>S'enregisrer</h1>

<form method="POST" action="/ctrl/register.php">
    <label>Prenom :</label><br>
    <input type="text" name="myName" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="myEmail" required><br><br>

    <label>Password :</label><br>
    <input type="password" name="myPassword" id="myPassword" required>
    <button type="button" onclick="togglePassword('myPassword')">👁</button><br><br>

    <label>Password :</label><br>
    <input type="password" name="myPasswordRepeat" id="myPasswordRepeat" required>
    <button type="button" onclick="togglePassword('myPasswordRepeat')">👁</button><br><br>

    <button type="submit">Validee</button>
</form>

<script>
function togglePassword(id) {
    const field = document.getElementById(id);
    field.type = field.type === 'password' ? 'text' : 'password';
}
</script>
