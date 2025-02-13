<h2>Create</h2>
<?= getFlash('message');?>
<form action="/user/store" method="post">
    <input type="text" name="name" placeholder="Seu nome">
    <?= getFlash('name');?>
    <br>
    <input type="text" name="lastName" placeholder="Seu sobrenome">
    <?= getFlash('lastName');?>
    <br>
    <input type="text" name="email" placeholder="Seu email">
    <?= getFlash('email');?>
    <br>
    <input type="password" name="password" placeholder="Sua senha">
    <?= getFlash('password');?>
    <br>
    <input type="submit" value="Create">
</form>