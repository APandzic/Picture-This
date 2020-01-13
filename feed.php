<?php

require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<div class="container-feed">
    <div class="container-error-message">
        <?php if ($message !== '') : ?>
            <p class="error-message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>

    <?php foreach (getAllPosts($pdo) as $post) : ?>
        <div class="container-feed-post-header">
            <div class="container-img-avatar-feed">
                <img class="img-avatar" src="<?php echo '/img-avatar/' . getUsersAvatar($post['user_id'], $pdo) ?>" alt="avatar">
            </div>
            <p><?php echo getUsersUsername($post['user_id'], $pdo); ?></p>
        </div>
        <img class="img-post" src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">

        <form class="form like-form" method="post">
            <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
            <button class="like-button" type="submit"><?php echo checkIfPostIsLiked($post['id'], $_SESSION['user']['id'], $pdo); ?></button>
            <div class="container-like-counter">
                <p class="like-counter"><?php echo count(getLikes($post['id'], $pdo)); ?></p>
                <p class="like-counter"> Likes</p>
            </div>
        </form>
        <div class="container-post-description">
            <a class="post-username" href="<?php echo "home.php?id=" . $post['user_id'] ?>"><?php echo getUsersUsername($post['user_id'], $pdo); ?></a>
            <p class="post-description"><?php echo $post['description']; ?></p>
        </div>

    <?php endforeach; ?>


</div>

<?php require __DIR__ . '/views/footer.php'; ?>
