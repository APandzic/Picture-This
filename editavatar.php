<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<article>
    <p>This is the edit avatar page.</p>
</article>
<?php if ($message !== '') : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>

<form action="app/users/editavatar.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="avatar">Choose a image to upload</label>
        <input type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" required>
    </div>

    <button type="submit">Upload</button>
</form>
<?php require __DIR__ . '/views/footer.php'; ?>
