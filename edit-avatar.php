<?php
require __DIR__.'/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>

<div class="container-edit-avatar">
    <?php if ($message !== '') { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <img class="image-edit-avatar" src="<?php echo '/img-avatar/'.$_SESSION['user']['profile_avatar']; ?>" alt="profile picture">

    <form action="app/users/edit-avatar.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="avatar">Choose a image to upload</label>
            <input id="input-file-edit-avatar" class="custom-file-input" type="file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" required>
        </div>

        <button type="submit">Upload</button>
    </form>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
