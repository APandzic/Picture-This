<nav class="navbar">

    <?php if (isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="<?php echo "/home.php?id=" . $_SESSION['user']['id']; ?>">Home</a>

    <?php endif; ?>

    <?php if (!isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/index.php">login</a>

    <?php endif; ?>

    <?php if (isset($_SESSION["user"])) : ?>

        <!-- <a class="nav-link" href="/edit-avatar.php">editavatar</a> -->

    <?php endif; ?>

    <!-- <a class="nav-link" href="/edit-settings.php">editsettings</a> -->

    <?php if (isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/new-post.php">newpost</a>

    <?php endif; ?>

    <?php if (!isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/registration.php">registration</a>

    <?php endif; ?>

    <?php if (isset($_SESSION["user"])) : ?>

        <a href="/app/users/logout.php">logout</a>

    <?php endif; ?>

    <?php if (isset($_SESSION["user"])) : ?>

        <a href="/feed.php">feed</a>

    <?php endif; ?>
</nav>
