<h2>Users</h2>

<ul>
    <?php foreach ($users as $user) : ?>
        <li><?= $user->name ?> | <a href="/user/<?= $user->id ?>">Detalhes</a></li>
    <?php endforeach; ?>
</ul>