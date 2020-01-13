<?php
require __DIR__ . '/views/header.php';

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

?>
<?php if ($message !== '') : ?>
    <p><?php echo $message; ?></p>
<?php endif; ?>
<form class="search-form" method="POST" autocomplete="on">
    <input class="search-input" type="text" name="search" placeholder="Search" autocomplete="off">
    <button type="submit">search</button>
</form>

<ul id="search-viewer">

</ul>

<?php require __DIR__ . '/views/footer.php'; ?>
