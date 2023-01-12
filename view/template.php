<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $header ?? '' ?>
    <title><?= $params->title ?></title>
</head>

<body>

        <div>
            <?= $content ?? '' ?>
        </div>

</body>

</html>
