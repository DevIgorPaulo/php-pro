<ul id="menu_list">
    <li><a href="/">Home</a></li>
    <li><a href="/login">Login</a></li>
    <li><a href="/user/create">Create</a></li>
</ul>

<div id="status_login">
    bem vindo,
    <?php if(logged()): ?>
        <?= user()->name ?> | <a href="/logout">Logout</a>
    <?php else: ?>
        Visitante 
    <?php endif; ?>    
    
</div>