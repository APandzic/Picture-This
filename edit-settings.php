<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
$biography = getUserBiography($_SESSION['user']['id'], $pdo)

?>
<div class="container-edit-settings">
    <article>
        <p>Edit profile and settings</p>
    </article>

    <div class="container-edit-settings-avatar">
        <div class="container-img-avatar">
            <img class="img-avatar" src="<?php echo '/img-avatar/' . $_SESSION['user']['profile_avatar'] ?>" alt="avatar">
        </div>

        <?php if (isset($_SESSION["user"])) : ?>

            <a href="/edit-avatar.php"><button>Edit profile picture</button></a>

        <?php endif; ?>
    </div>

    <form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

        <div class="container-inside-form">
            <label for="username">Username</label>
            <input type="username" name="username" placeholder="<?php echo $_SESSION['user']['username']; ?>" required>
        </div>

        <button type="submit">Change username</button>
    </form>

    <form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

        <div class="container-inside-form">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        <div class="container-inside-form">
            <label for="newPassword">New Password</label>
            <input type="password" name="newPassword" required>
        </div>
        <div class="container-inside-form">
            <label for="confirmNewPassword">Confirm New Password</label>
            <input type="Password" name="confirmNewPassword" required>
        </div>

        <button type="submit">Change Password</button>
    </form>

    <form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

        <div class="container-inside-form">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="<?php echo $_SESSION['user']['email']; ?>" required>
        </div>

        <button type="submit">change email</button>
    </form>

    <form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

        <div class="container-inside-form">
            <label for="biography">Biography</label>
            <textarea type="text" name="biography" cols="30" rows="10"><?php echo $biography; ?></textarea>
        </div>
        <button type="submit">Edit biography</button>
    </form>


</div>


<?php if ($message !== '') : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>


<?php require __DIR__ . '/views/footer.php'; ?>
