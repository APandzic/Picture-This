<nav>
    <a href="#"><?php echo $config['title']; ?></a>

    <ul>
        <li>
            <a class="nav-link" href="/index.php">Home</a>
        </li>

        <?php if (!isset($_SESSION["user"])) : ?>
            <li>
                <a class="nav-link" href="/login.php">login</a>
            </li>
        <?php endif; ?>

        <?php if (isset($_SESSION["user"])) : ?>
            <li>
                <a class="nav-link" href="/edit-avatar.php">editavatar</a>
            </li>
        <?php endif; ?>

        <li>
            <a class="nav-link" href="/edit-like.php">editlike</a>
        </li>

        <li>
            <a class="nav-link" href="/edit-post.php">editpost</a>
        </li>

        <li>
            <a class="nav-link" href="/edit-settings.php">editsettings</a>
        </li>

        <li>
            <a class="nav-link" href="/new-post.php">newpost</a>
        </li>

        <?php if (!isset($_SESSION["user"])) : ?>
            <li>
                <a class="nav-link" href="/registration.php">registration</a>
            </li>
        <?php endif; ?>

        <?php if (isset($_SESSION["user"])) : ?>
            <li>
                <a href="/app/users/logout.php">logout</a>
            </li>
        <?php endif; ?>

    </ul>
</nav>
