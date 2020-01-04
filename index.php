<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>
<div class="container-header-username">
    <h1 class="header-username"><?php echo $_SESSION['user']['username']; ?></h1>
</div>

<div class="container-img-avatar">
    <img class="img-avatar" src="<?php echo '/img-avatar/' . $_SESSION['user']['profile_avatar'] ?>" alt="avatar">
</div>

<div class="container-header-fullname">
    <h1 class="header-fullname"><?php echo ucfirst($_SESSION['user']['first_name']) . ' ' . ucfirst($_SESSION['user']['last_name']); ?></h1>
</div>

<div class="container-biography">
    <p class="biography"><?php echo getUserBiography($_SESSION['user']['id'], $pdo); ?></p>
</div>

<?php if (isset($_SESSION["user"])) : ?>
    <div class="container-edit-button">
        <a href="/edit-settings.php">
            <button class="edit-button">Edit Profile</button>
        </a>
    </div>
<?php endif; ?>

<!-- to print out every post made -->
<?php foreach (getUserPosts($_SESSION['user']['id'], $pdo) as $post) : ?>
    <a href="<?php echo "edit-post.php?id=" . $post['id'] ?>">
        <img class="img-post" src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">
    </a>
    <form class="form like-form" method="post">
        <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
        <button class="like-button" type="submit"><?php echo checkIfPostIsLiked($post['id'], $_SESSION['user']['id'], $pdo); ?></button>
        <div class="container-like-counter">
            <p class="like-counter"><?php echo getLikeCount($post['id'], $pdo); ?></p>
            <p class="like-counter"> Likes</p>
        </div>
    </form>
    <div class="container-post-description">
        <p class="post-username"><?php echo $_SESSION['user']['username']; ?></p>
        <p class="post-description"><?php echo $post['description']; ?></p>
    </div>

<?php endforeach; ?>
<?php require __DIR__ . '/views/footer.php'; ?>
