<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>
<div class="container-follow-list">
    <div class="container-header-username">
        <h1 class="header-username"><?php echo getUsersUsername($_GET['id'], $pdo); ?></h1>
    </div>
    <div class="inner-container-follow-list">
        <div class="container-follow-following">
            <h1>Followers</h1>
            <?php foreach (getFollowers($_GET['id'], $pdo) as $user) : ?>
                <a href="/home.php?id=<?php echo $user['users_id']; ?>">
                    <div class="container-follow-list-avatar-username">
                        <div class="container-img-avatar">
                            <img class="img-avatar" src="<?php echo '/img-avatar/' . getUsersAvatar($_GET['id'], $pdo) ?>" alt="avatar" loading="lazy">
                        </div>
                        <p class="hyperlink-username"><?php echo getUsersUsername($user['follows_id'], $pdo); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="container-follow-following">
            <h1>Following</h1>
            <?php foreach (getfollowing($_GET['id'], $pdo) as $user) : ?>
                <a href="/home.php?id=<?php echo $user['follows_id']; ?>">
                    <div class="container-follow-list-avatar-username">
                        <div class="container-img-avatar">
                            <img class="img-avatar" src="<?php echo '/img-avatar/' . getUsersAvatar($_GET['id'], $pdo) ?>" alt="avatar" loading="lazy">
                        </div>
                        <p class="hyperlink-username"><?php echo getUsersUsername($user['follows_id'], $pdo); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
