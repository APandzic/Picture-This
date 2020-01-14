<nav class="navbar">

    <?php if (isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="<?php echo "/home.php?id=" . $_SESSION['user']['id']; ?>">Home</a>

    <?php endif; ?>


    <?php if (isset($_SESSION["user"])) : ?>

        <a class="nav-link" href="/new-post.php">newpost</a>

    <?php endif; ?>

    <?php if (isset($_SESSION["user"])) : ?>

        <a href="/feed.php">feed</a>

    <?php endif; ?>
    <?php if (isset($_SESSION["user"])) : ?>

        <a href="/search.php">search</a>

    <?php endif; ?>
</nav>
