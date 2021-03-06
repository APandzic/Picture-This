<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

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

            <a href="/edit-avatar.php"><button class="button-edit-profile">Edit profile picture</button></a>

        <?php endif; ?>
    </div>

    <?php if ($message !== '') : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <div>
        <?php if (isset($_SESSION["user"])) : ?>

            <a href="/app/users/logout.php"><button class="button-logout">Logout</button></a>

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
            <small>Password must be at least 8 characters, include one upper case letter and one number.</small>
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
            <input type="email" name="email" required>
        </div>

        <button type="submit">change email</button>
    </form>

    <form action="app/users/edit-settings.php" method="post" enctype="multipart/form-data">

        <div class="container-inside-form">
            <label for="biography">Biography</label>
            <textarea placeholder="add a comment" type="text" name="biography" maxlength="100"><?php echo getUserBiographyString($_SESSION['user']['id'], $pdo); ?></textarea>
            <small>Max 50 characters and 4 lines.</small>
        </div>
        <button type="submit">Edit biography</button>
    </form>

    <form class="form-delete" action="/app/users/delete.php" method="get" enctype="multipart/form-data">

        <button class="button-logout" type="submit" name="delete-account" value="<?php echo $_SESSION['user']['id'] ?>">Delete Account</button>

    </form>


</div>


<?php require __DIR__ . '/views/footer.php'; ?>