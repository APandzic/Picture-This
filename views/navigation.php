<nav class="navbar">
    <a class="nav-link" href="/index.php">Home</a>

    <?php if (!isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/login.php">login</a>

    <?php endif; ?>

    <?php if (isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/edit-avatar.php">editavatar</a>

    <?php endif; ?>

    <a class="nav-link" href="/edit-settings.php">editsettings</a>

    <a class="nav-link" href="/new-post.php">newpost</a>

    <?php if (!isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/registration.php">registration</a>

    <?php endif; ?>

    <?php if (isset($_SESSION["user"])) : ?>

        <a href="/app/users/logout.php">logout</a>

    <?php endif; ?>
</nav>
