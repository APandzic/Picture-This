<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$_SESSION['user'] = [];
session_destroy();

redirect('/');
