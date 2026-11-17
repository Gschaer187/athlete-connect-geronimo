# Projektbriefing · Athlete Connect

## Person und Angebot

Geronimo Schär spielt als Goalie bei HC Davos in der U18-Elit. 2026 wurde er mit der U16-Elit des HCD Schweizer Meister. Sein Ziel ist der Schritt Richtung Nordamerika. Die Webseite stellt ihn als Sportler vor und nimmt Anfragen von Partnern entgegen.

## Zielgruppe

**Primär: Sponsoring.** Gemeint sind lokale Firmen und Sportmarken, die einen jungen Athleten unterstützen möchten, zum Beispiel mit Geld oder mit Goalie-Ausrüstung.

**Ihr Problem heute:** Eine Firma, die Interesse hat, schreibt per Instagram-Nachricht oder über den Club. Oft fehlt darin, wer die Firma ist, was sie anbieten möchte und wie man sie erreicht. Die Nachrichten gehen zwischen Training und Schule unter, und Geronimo muss jedes Mal nachfragen.

Sekundär können auch Medien, Clubs und Eventveranstalter das Formular nutzen.

## User Story

> Als **Marketingverantwortliche einer Firma** möchte ich **über die Webseite eine Sponsoring-Anfrage mit Firma, Art der Unterstützung und Kontaktadresse senden**, damit **Geronimo alle nötigen Angaben auf einmal hat und gezielt antworten kann**.

## Akzeptanzkriterien

- [ ] Name, E-Mail, Anfrageart, Nachricht und Zustimmung sind Pflichtfelder. Die Firma ist optional.
- [ ] Die Anfrageart akzeptiert nur die fünf vorgesehenen Werte: Sponsoring, Materialpartner, Medien, Club/Camp und Event.
- [ ] Bei einer ungültigen Eingabe erscheint direkt beim betroffenen Feld eine Meldung, die sagt, was zu korrigieren ist. Bereits eingegebene Werte bleiben stehen.
- [ ] Eine gültige Anfrage wird genau einmal in SQLite gespeichert, mit Name, Firma, E-Mail, Anfrageart, Nachricht und Zeitpunkt.
- [ ] Nach dem Senden erscheint eine Bestätigung. Wer die Seite danach neu lädt, erzeugt keinen zweiten Eintrag.
- [ ] Das Formular lässt sich bei 320 px Breite und nur mit der Tastatur vollständig ausfüllen und senden.

## Daten

### Diese Daten brauche ich

| Feld | Warum |
|---|---|
| Name | Damit ich weiss, mit wem ich schreibe |
| Firma (optional) | Bei Sponsoring wichtig, bei Medien oder Privatpersonen nicht immer vorhanden |
| Geschäftliche E-Mail | Für die Antwort |
| Anfrageart | Damit ich Anfragen sortieren kann |
| Nachricht | Inhalt der Anfrage, z. B. Angebot, Zeitraum, Idee |
| Zeitpunkt | Wird vom Server gesetzt, nicht vom Formular |

### Diese Daten erhebe ich bewusst nicht

- Gesundheitsdaten und Leistungsdiagnostik
- Wohnadresse (meine und die der Absender)
- private Telefonnummern
- Geburtsdatum
- Budget oder Vertragssummen (gehören in ein persönliches Gespräch, nicht in ein Webformular)

Im öffentlichen Repository stehen nur erfundene Testanfragen.

## Datenfluss

```
Browser ──POST──▶ public/index.php ──▶ Validator ──gültig──▶ Repository ──▶ SQLite
   ▲                                       │
   │                                    ungültig
   │                                       ▼
   └──── Redirect (GET) mit Bestätigung ◀── Formular mit Fehlern
```

1. Die Firma füllt das Formular im Browser aus und klickt auf «Anfrage senden».
2. Der Browser schickt die Werte per POST an `public/index.php`.
3. Der Server prüft Pflichtfelder, E-Mail-Format, Längen und die erlaubten Anfragearten.
4. Ist etwas ungültig, zeigt PHP das Formular mit Fehlermeldungen und den eingegebenen Werten wieder an. Nichts wird gespeichert.
5. Ist alles gültig, speichert das Repository die Anfrage mit einem Prepared Statement in SQLite.
6. PHP leitet per Redirect auf eine GET-Seite weiter und zeigt dort die Bestätigung.

**Wo entscheidet der Server, ob gespeichert wird?** In Schritt 3, im Validator. Nur wenn er keine Fehler meldet, darf das Repository speichern.
