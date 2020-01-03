<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>
<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
</article>


<!-- to print out every post made -->
<?php foreach (getUserPosts($_SESSION['user']['id'], $pdo) as $post) : ?>
    <a href="<?php echo "edit-post.php?id=" . $post['id'] ?>">
        <img src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">
    </a>
    <form class="form" method="post">
        <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
        <button class="likeButton" type="submit">like</button>
        <div>
            <p class="likeCounter"><?php echo getLikeCount($post['id'], $pdo); ?></p>
        </div>
    </form>
    <p><?php echo $post['description']; ?></p>

<?php endforeach; ?>
<?php require __DIR__ . '/views/footer.php'; ?>
