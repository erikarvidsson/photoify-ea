<?php

declare(strict_types=1);

require __DIR__.'/app/autoload.php';

session_unset();
session_destroy();

redirect('/');
// In this file we logout users.
echo 'lalql';
