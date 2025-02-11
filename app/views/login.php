<h2>Login</h2>
<?= getFlash('message') ?>
    <form action="/login" method="POST" id="box-login">
        <input type="text" value="gio@email.com" name="email" id="email" placeholder="Seu email">
        <input type="password" value="123" name="password" id="password" placeholder="Sua senha">
        <button type="submit">Login</button>
    </form>

