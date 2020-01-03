<?php
// Always start by loading the default application setup.
require __DIR__ . '/../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $config['title']; ?></title>

    <link href="https://unpkg.com/sanitize.css" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/style/main.css">
    <link rel="stylesheet" href="/assets/style/navigation.css">
    <link rel="stylesheet" href="/assets/style/index.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body>

    <?php require __DIR__ . '/navigation.php'; ?>
