<?php

declare(strict_types=1);

/*
 * Zeigt die gespeicherten Anfragen im Terminal an.
 * Aufruf im Projektordner:   php tools/show-inquiries.php
 *
 * Nur für die Entwicklung gedacht. Liegt bewusst NICHT in /public,
 * damit es niemand über den Browser aufrufen kann.
 */

require_once dirname(__DIR__) . '/src/Database.php';
require_once dirname(__DIR__) . '/src/InquiryRepository.php';

$repository = new InquiryRepository(Database::connect());
$rows = $repository->latest();

if ($rows === []) {
    echo "Noch keine Anfragen gespeichert.\n";
    exit(0);
}

echo count($rows) . " Anfrage(n), neueste zuerst:\n\n";

foreach ($rows as $row) {
    printf(
        "#%d  %s  [%s]\n    %s%s <%s>\n    %s\n\n",
        $row['id'],
        $row['created_at'],
        $row['request_type'],
        $row['name'],
        $row['organisation'] !== '' ? ' (' . $row['organisation'] . ')' : '',
        $row['email'],
        mb_strimwidth(str_replace("\n", ' ', $row['message']), 0, 70, '…')
    );
}
