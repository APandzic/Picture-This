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

    <link rel="stylesheet" href="/assets/style/san.css">
    <link rel="stylesheet" href="/assets/style/main.css">
    <link rel="stylesheet" href="/assets/style/navigation.css">
    <link rel="stylesheet" href="/assets/style/home.css">
    <link rel="stylesheet" href="/assets/style/edit-settings.css">
    <link rel="stylesheet" href="/assets/style/new-post.css">
    <link rel="stylesheet" href="/assets/style/edit-post.css">
    <link rel="stylesheet" href="/assets/style/login.css">
    <link rel="stylesheet" href="/assets/style/edit-avatar.css">
    <link rel="stylesheet" href="/assets/style/registration.css">
    <link rel="stylesheet" href="/assets/style/feed.css">
    <link rel="stylesheet" href="/assets/style/follow-list.css">
    <link rel="stylesheet" href="/assets/style/search.css">
</head>

<body>

    <?php require __DIR__ . '/navigation.php'; ?>
