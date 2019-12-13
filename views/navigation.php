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

        <li>
            <a class="nav-link" href="/editavatar.php">editavatar</a>
        </li>

        <li>
            <a class="nav-link" href="/editlike.php">editlike</a>
        </li>

        <li>
            <a class="nav-link" href="/editpost.php">editpost</a>
        </li>

        <li>
            <a class="nav-link" href="/editsettings.php">editsettings</a>
        </li>

        <li>
            <a class="nav-link" href="/newpost.php">newpost</a>
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
