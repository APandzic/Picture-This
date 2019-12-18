<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>
<article>
    <p>This is the edit settings page.</p>
</article>

<form action="<?php echo "/app/posts/edit-settings.php?id=" . $post['id'] ?>" method="post" enctype="multipart/form-data">

    <div>
        <label for="username">Username</label>
        <input type="username" name="username" placeholder="puffy" required>
        <small>Please provide your new username.</small>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <small>Please provide your old password (passphrase).</small>
    </div>
    <div>
        <label for="newPassword">Password</label>
        <input type="password" name="password" required>
        <small>Please provide your new password (passphrase).</small>
    </div>
    <div>
        <label for="confirmNewPassword">Confirm Password</label>
        <input type="Password" name="confirmPassword" required>
        <small>Please confirm your password (passphrase).</small>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="andreas@gmail.com" required>
        <small>Please provide your new email address.</small>
    </div>

    <?php if ($message !== '') : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <button type="submit">Upload</button>
</form>


<?php require __DIR__ . '/views/footer.php'; ?>
