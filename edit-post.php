<?php
require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$post = getUserPostbyid($_GET['id'], $pdo);
?>

<div class="container-edit-post">
    <article>
        <p>This is the edit post page.</p>
    </article>

    <?php if ($message !== '') { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <tbody>
        <tr>
            <td><a href="<?php echo '/app/posts/delete-post.php?id='.$post['id'].'&name='.$post['post_img'] ?>"><button class="delete-buttom">Delete</button></a></td>
        </tr>
    </tbody>

    <img class="image-edit-post" src="<?php echo '/img-posts/'.$post['post_img']; ?>" alt="posts">

    <form action="<?php echo '/app/posts/edit-post.php?id='.$post['id'] ?>" method="post" enctype="multipart/form-data">

        <div>
            <label for="post">Change image to upload</label>
            <input id="input-file-edit-post" class="custom-file-input" type="file" name="post" accept=".png, .jpg, .jpeg">
        </div>
        <div>
            <label for="description">Change Description</label>
            <textarea type="text" name="description" cols="30" rows="10"><?php echo $post['description']; ?></textarea>
        </div>
        <button type="submit">Change</button>
    </form>


    <?php require __DIR__.'/views/footer.php'; ?>
</div>
