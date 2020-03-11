<?php
require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<div class="container-new-post">
    <article>
        <p>This is the new post page.</p>
    </article>
    <?php if ($message !== '') { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <form action="app/posts/new-post.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="post">Choose a image to upload</label>
            <input class="custom-file-input" id="input-file" type="file" name="post" accept=".png, .jpg, .jpeg" required>
            <div class="image-preview" id="image-id-preview">
                <img src="" alt="Image Preview" class="image-preview-image">
                <span class="image-preview-default-text">Image Preview</span>
            </div>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea type="text" name="description" cols="30" rows="10"></textarea>
        </div>

        <button type="submit">Upload</button>
    </form>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
