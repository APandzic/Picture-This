<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$biography = getUserBiography($_SESSION['user']['id'], $pdo)

?>
<article>
    <p>This is the edit settings page.</p>
</article>

<?php if (isset($_SESSION["user"])) : ?>

    <a class="nav-link" href="/edit-avatar.php">editavatar</a>

<?php endif; ?>

<form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

    <div>
        <label for="username">Username</label>
        <input type="username" name="username" placeholder="puffy" required>
        <small>Please provide your new username.</small>
    </div>

    <button type="submit">Change username</button>
</form>

<form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

    <div>
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <small>Please provide your old password (passphrase).</small>
    </div>
    <div>
        <label for="newPassword">New Password</label>
        <input type="password" name="newPassword" required>
        <small>Please provide your new password (passphrase).</small>
    </div>
    <div>
        <label for="confirmNewPassword">Confirm New Password</label>
        <input type="Password" name="confirmNewPassword" required>
        <small>Please confirm your password (passphrase).</small>
    </div>

    <button type="submit">Change Password</button>
</form>

<form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="andreas@gmail.com" required>
        <small>Please provide your new email address.</small>
    </div>

    <button type="submit">change email</button>
</form>

<form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

    <div>
        <label for="biography">biography</label>
        <textarea type="text" name="biography" cols="30" rows="10"><?php echo $biography['biography']; ?></textarea>
        <small>Please provide a descrition of the account in biography</small>
    </div>
    <button type="submit">Edit biography</button>
</form>




<?php if ($message !== '') : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>
