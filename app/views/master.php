<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title><?= $title ?></title>
</head>
<body>
    <div id="header">
        <?php require VIEWS.'/partials/header.php'; ?>
    </div>
    <div class="container">
        <?php require VIEWS.$view; ?>
    </div>
</body>
</html>