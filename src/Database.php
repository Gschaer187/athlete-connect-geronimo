<?php

declare(strict_types=1);

/**
 * Verantwortlich für: Verbindung zur SQLite-Datenbank und Tabellenschema.
 *
 * PDO = "PHP Data Objects", die eingebaute Schnittstelle von PHP zu Datenbanken.
 */
final class Database
{
    public static function connect(): PDO
    {
        // Die Datei liegt in /storage, also AUSSERHALB von /public.
        // So kann niemand die Datenbank über den Browser herunterladen.
        $databasePath = dirname(__DIR__) . '/storage/athlete-connect.sqlite';

        $pdo = new PDO('sqlite:' . $databasePath);

        // Bei Datenbankfehlern eine Exception werfen statt still weiterzumachen
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Resultate als Array mit Spaltennamen zurückgeben
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Tabelle beim ersten Aufruf automatisch anlegen
        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS inquiries (
                id           INTEGER PRIMARY KEY AUTOINCREMENT,
                name         TEXT NOT NULL,
                organisation TEXT NOT NULL DEFAULT \'\',
                email        TEXT NOT NULL,
                request_type TEXT NOT NULL,
                message      TEXT NOT NULL,
                created_at   TEXT NOT NULL
            )'
        );

        return $pdo;
    }
}
