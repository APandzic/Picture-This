<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$post = getUserPostbyid($_GET['id'], $pdo);
?>
<article>
    <p>This is the edit post page.</p>
</article>

<?php if ($message !== '') : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<img src="<?php echo '/img-posts/' . $post['post_img']; ?>" alt="posts">

<form action="<?php echo "/app/posts/edit-post.php?id=" . $post['id'] ?>" method="post" enctype="multipart/form-data">

    <div>
        <label for="post">Choose a image to upload</label>
        <input type="file" name="post" accept=".png, .jpg, .jpeg">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea type="text" name="description" cols="30" rows="10"><?php echo $post['description']; ?></textarea>
        <small>Please provide a descrition for the post.</small>
    </div>
    <button type="submit">Upload</button>
</form>

<tbody>
    <tr>
        <td><a href="<?php echo "/app/posts/delete-post.php?id=" . $post['id'] . "&name=" . $post['post_img'] ?>">Delete</a></td>
    </tr>
</tbody>
<?php require __DIR__ . '/views/footer.php'; ?>