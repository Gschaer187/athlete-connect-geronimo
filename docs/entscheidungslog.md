# Entscheidungslog

| Datum | Entscheidung oder Blockade | Optionen | Begründung | Quelle/KI | Auswirkung/Test |
|---|---|---|---|---|---|
| 2026-11-17 | Rückstand von ca. zwei Monaten wegen Training | Alles allein nachholen; mit Referenz und KI-Hilfe arbeiten | Flexible Route für Leistungssport erlaubt den Wiedereinstieg über Lernjob und Referenz | Claude (KI) als Lernbegleitung, Kurs-Lernjobs | Jede Etappe als eigener Commit nachvollziehbar |
| 2026-11-17 | Seite über mich selbst statt fiktive Person | Eigene Person; erfundene Persona | Echter Anwendungsfall, ich kenne die Anfragen aus eigener Erfahrung. Nur öffentliche Infos (Club, Position, Titel) | eigene Entscheidung | Datenschutz-Check: keine Adresse, keine Gesundheitsdaten im Repo |
| 2026-11-17 | Primäre Zielgruppe Sponsoring | Sponsoring, Medien, Club, Event | Für einen Junior mit Ziel Nordamerika sind Sponsoren und Materialpartner am wichtigsten | eigene Entscheidung | Akzeptanzkriterien im Briefing |
| 2026-11-17 | Fünf Anfragearten inkl. «Materialpartner» | Nur Sponsoring allgemein; Material separat | Goalie-Ausrüstung ist teuer und ein häufiger Sponsoring-Grund, deshalb eigene Kategorie | eigene Entscheidung | Allowlist im Validator (Etappe 04) |
| 2026-11-17 | Kein Budgetfeld | Budgetfeld; kein Budgetfeld | Vertragssummen gehören nicht in ein öffentliches Formular (Datensparsamkeit) | Lernjob 01 | Liste «bewusst nicht erhoben» |
| 2026-11-17 | Formular klassisch per POST + Redirect statt per JavaScript/JSON | DB-Vorlage `m307_DB_start` (fetch + JSON-API); Kursmuster POST → Redirect → GET | Der Lernjob 03 verlangt PRG. Das Formular funktioniert auch ohne JavaScript, und F5 erzeugt keine doppelte Anfrage | Lernjob 03, Kursreferenz, Claude (KI) | Test: Seite nach dem Senden neu laden → nur ein Datensatz |
| 2026-11-17 | Datenbank in `/storage` statt in `/public` | Datei neben `index.php`; eigener Ordner ausserhalb `public` | Was in `/public` liegt, kann man im Browser herunterladen. Die Datenbank darf das nicht | Lernjob 03 | `http://localhost:8080/../storage/...` liefert nichts |
| 2026-11-17 | Hilfsskript `tools/show-inquiries.php` | DB-Programm installieren; kleines PHP-Skript | Ohne Zusatzsoftware prüfen, ob eine Anfrage genau einmal gespeichert wurde | eigene Idee mit KI-Hilfe | `php tools/show-inquiries.php` zeigt die Einträge |

## Hinweise

- Dokumentiere Entscheidungen, nicht jede Tastatureingabe.
- Nenne übernommene Muster, Personen, Dokumentationen oder KI-Hilfe.
- Halte fest, woran du erkennst, dass die Entscheidung funktioniert.
