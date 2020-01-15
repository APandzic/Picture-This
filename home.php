<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<div class="container-home">
    <div class="container-header-username">
        <h1 class="header-username"><?php echo getUsersUsername($_GET['id'], $pdo); ?></h1>
    </div>

    <div class="container-avatar-follow">
        <div class="container-img-avatar">
            <img class="img-avatar" src="<?php echo '/img-avatar/' . getUsersAvatar($_GET['id'], $pdo) ?>" alt="avatar">
        </div>

        <div class="container-follow-counter">
            <div class="inner-container-follow">
                <p><span><?php echo count(getUserPosts($_GET['id'], $pdo)); ?></span></p>
                <p>posts</p>
            </div>
            <a href="<?php echo "follow-list.php?id=" . $_GET['id'] ?>">
                <div class="inner-container-follow">
                    <p><span class="follow-counter"><?php echo count(getFollowers($_GET['id'], $pdo)); ?></span></p>
                    <p>Followers</p>
                </div>
            </a>
            <a href="<?php echo "follow-list.php?id=" . $_GET['id'] ?>">
                <div class="inner-container-follow">
                    <p><span><?php echo count(getfollowing($_GET['id'], $pdo)); ?></span></p>
                    <p>Following</p>
                </div>
            </a>
        </div>
    </div>

    <div class="container-header-fullname">
        <h1 class="header-fullname"><?php echo ucfirst(getUsersFirstName($_GET['id'], $pdo)) . ' ' . ucfirst(getUsersLastName($_GET['id'], $pdo)); ?></h1>
    </div>

    <div class="container-biography">
        <?php foreach (getUserBiographyArray($_GET['id'], $pdo) as $row) : ?>
            <p class="biography"><?php echo $row; ?></p>
        <?php endforeach; ?>
    </div>

    <div class="container-home-follow-button">
        <?php if ($_SESSION["user"]['id'] != $_GET['id']) : ?>
            <form class="form-follow follow-form" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <button class="follow-button" type="submit"><?php echo checkIfUserFollowsAccount($_GET['id'], $_SESSION['user']['id'], $pdo); ?></button>
            </form>
        <?php endif; ?>
    </div>

    <?php if ($_SESSION["user"]['id'] === $_GET['id']) : ?>
        <div class="container-edit-button">
            <a href="/edit-settings.php">
                <button class="edit-button">Edit Profile</button>
            </a>
        </div>
    <?php endif; ?>



    <!-- if no post is made -->
    <?php if (count(getUserPosts($_GET['id'], $pdo)) === 0 && $_SESSION["user"]['id'] === $_GET['id']) : ?>
        <div class="container-block"></div>
        <div class="container-no-post">
            <img class="img-icon-no-post" src="/img-icons/add.png" alt="icon-add">
            <h1>Share photos</h1>
            <p>when you share photos, they'll appear on your profile</p>
        </div>
    <?php endif; ?>
    <?php if (count(getUserPosts($_GET['id'], $pdo)) === 0 && $_SESSION["user"]['id'] !== $_GET['id']) : ?>
        <div class="container-block"></div>
        <div class="container-no-post">
            <h1>This user has no post</h1>
        </div>
    <?php endif; ?>


    <!-- to print out every post made -->
    <?php foreach (getUserPosts($_GET['id'], $pdo) as $post) : ?>
        <div class="container-home-post">
            <div class="container-feed-post-header">
                <div class="container-img-avatar-feed">
                    <img class="img-avatar" src="<?php echo '/img-avatar/' . getUsersAvatar($post['user_id'], $pdo) ?>" alt="avatar">
                </div>
                <p><?php echo getUsersUsername($post['user_id'], $pdo); ?></p>
            </div>
            <?php if ($_SESSION["user"]['id'] === $_GET['id']) : ?>
                <a href="<?php echo "edit-post.php?id=" . $post['id'] ?>">
                    <img class="img-post" src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">
                </a>
            <?php else : ?>
                <img class="img-post" src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">
            <?php endif; ?>
            <form class="form like-form" method="post">
                <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
                <button class="like-button" type="submit"><?php echo checkIfPostIsLiked($post['id'], $_SESSION['user']['id'], $pdo); ?></button>
                <div class="container-like-counter">
                    <p class="like-counter"><?php echo count(getLikes($post['id'], $pdo)); ?></p>
                    <p class="like-counter"> Likes</p>
                </div>
            </form>
            <div class="container-post-description">
                <p class="post-username"><?php echo getUsersUsername($_GET['id'], $pdo); ?></p>
                <p class="post-description"><?php echo $post['description']; ?></p>
            </div>
        </div>

    <?php endforeach; ?>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>
