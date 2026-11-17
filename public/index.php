<?php

declare(strict_types=1);

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';

require dirname(__DIR__) . '/templates/home.php';

