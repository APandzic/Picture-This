<?php if (isset($_SESSION["user"])) : ?>
    <nav class="navbar">

        <?php if (isset($_SESSION["user"])) : ?>

            <div class="container-img-nav">
                <a href="/feed.php">
                    <img class="img-icon" src="/img-icons/feed.png" alt="icon-feed">
                </a>
            </div>

        <?php endif; ?>


        <?php if (isset($_SESSION["user"])) : ?>

            <div class="container-img-nav">
                <a href="/new-post.php">
                    <img class="img-icon" src="/img-icons/add.png" alt="icon-add">
                </a>
            </div>

        <?php endif; ?>


        <?php if (isset($_SESSION["user"])) : ?>

            <div class="container-img-nav">
                <a href="/search.php">
                    <img class="img-icon" src="/img-icons/search.png" alt="icon-search">
                </a>
            </div>

        <?php endif; ?>

        <?php if (isset($_SESSION["user"])) : ?>

            <div class="container-img-nav">
                <a href="<?php echo "/home.php?id=" . $_SESSION['user']['id']; ?>">
                    <img class="img-icon" src="<?php echo '/img-avatar/' . getUsersAvatar($_SESSION['user']['id'], $pdo) ?>" alt="avatar">
                </a>
            </div>

        <?php endif; ?>
    </nav>
<?php endif; ?>
