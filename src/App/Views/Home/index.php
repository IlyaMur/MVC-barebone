<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Welcome</h1>
    <p>Hello from view!</p>
    <?= $name ?>
    <ul>
        <?php foreach ($colors as $color) : ?>
            <li> <?= $color ?></li>
        <?php endforeach ?>
    </ul>
</body>

</html>