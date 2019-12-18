<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>
<article>
    <p>This is the new post page.</p>
</article>
<?php if ($message !== '') : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form action="app/posts/new-post.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="post">Choose a image to upload</label>
        <input type="file" name="post" accept=".png, .jpg, .jpeg" required>
    </div>
    <div>
        <label for="description">Description</label>
        <textarea type="text" name="description" cols="30" rows="10"></textarea>
        <small>Please provide a descrition for the post.</small>
    </div>

    <button type="submit">Upload</button>
</form>

<!-- to print out every post made -->
<?php foreach (getUserPosts($_SESSION['user']['id'], $pdo) as $post) : ?>
    <a href="<?php echo "edit-post.php?id=" . $post['id'] ?>">
        <img src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">
    </a>
    <p><?php echo $post['description']; ?></p>

<?php endforeach; ?>



<?php require __DIR__ . '/views/footer.php'; ?>
