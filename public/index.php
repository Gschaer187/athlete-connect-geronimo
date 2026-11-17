<?php

declare(strict_types=1);

/*
 * Einstiegspunkt: Jeder Aufruf der Seite landet hier.
 *
 * Ablauf (Etappe 03, Happy Path):
 *   GET  /          → Formular anzeigen
 *   POST /          → Werte lesen → speichern → Redirect
 *   GET  /?sent=1   → Formular + Bestätigung anzeigen
 *
 * Die vollständige serverseitige Validierung, CSRF-Schutz und Honeypot
 * kommen in Etappe 04. Bis dahin ist dieser Stand NOCH NICHT SICHER.
 */

require_once dirname(__DIR__) . '/src/Database.php';
require_once dirname(__DIR__) . '/src/InquiryRepository.php';

/** Liest einen Textwert aus dem Formular. Fehlt er oder ist er kein Text, gibt es ''. */
function textInput(string $key): string
{
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

/** Escaping: macht Text für die HTML-Ausgabe harmlos (< wird zu &lt; usw.). */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Anfragearten: Wert im HTML => sichtbarer Text
$requestTypes = [
    'sponsoring' => 'Sponsoring / Partnerschaft',
    'material'   => 'Materialpartner (Ausrüstung)',
    'media'      => 'Medien / Interview',
    'club'       => 'Club / Camp',
    'event'      => 'Event / Auftritt',
];

// Startwerte für ein leeres Formular
$values = [
    'name'         => '',
    'organisation' => '',
    'email'        => '',
    'request_type' => '',
    'message'      => '',
];
$requestFailed = false;

// Nur ein POST-Request darf etwas speichern
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    foreach (array_keys($values) as $key) {
        $values[$key] = textInput($key);
    }

    // Minimaler Schutz gegen leere Datensätze. Die echte Prüfung folgt in Etappe 04.
    $requiredFilled = $values['name'] !== ''
        && $values['email'] !== ''
        && $values['request_type'] !== ''
        && $values['message'] !== '';

    if ($requiredFilled) {
        $repository = new InquiryRepository(Database::connect());
        $repository->save($values);

        // POST → Redirect → GET:
        // 303 sagt dem Browser "lade jetzt diese Adresse per GET".
        // Wer danach F5 drückt, lädt nur die Bestätigungsseite neu und sendet NICHT nochmals.
        header('Location: /?sent=1#anfrage', true, 303);
        exit;
    }

    $requestFailed = true;
}

$sent = ($_GET['sent'] ?? '') === '1';

require dirname(__DIR__) . '/templates/home.php';
