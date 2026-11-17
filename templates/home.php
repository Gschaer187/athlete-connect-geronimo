<!doctype html>
<html lang="de-CH">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Athlete Connect · Starter</title>
  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
  <main>
    <section class="profile">
      <p class="eyebrow">Athlete Connect · Starter</p>
      <h1>Alex<br>Example</h1>
      <p class="lead">TODO: Ersetze dieses Testprofil durch deine eigene erfundene Athlet:innen-Persona.</p>
      <dl>
        <div><dt>Sport</dt><dd>TODO</dd></div>
        <div><dt>Ziel</dt><dd>TODO</dd></div>
      </dl>
    </section>

    <section class="contact" aria-labelledby="contact-title">
      <p class="eyebrow">Kontakt</p>
      <h2 id="contact-title">Anfrage senden</h2>

      <?php if ($submitted): ?>
        <div class="notice" role="status">
          Der Browser hat Daten gesendet. Speichern und serverseitiges Prüfen baust du in den Etappen 3 und 4.
        </div>
      <?php endif; ?>

      <form method="post">
        <label for="name">Name</label>
        <input id="name" name="name" required maxlength="80" autocomplete="name">

        <label for="email">E-Mail</label>
        <input id="email" name="email" type="email" required maxlength="160" autocomplete="email">

        <label for="request_type">Art der Anfrage</label>
        <select id="request_type" name="request_type" required>
          <option value="">Bitte wählen</option>
          <option value="sponsoring">Sponsoring</option>
          <option value="media">Medien</option>
          <option value="event">Event</option>
        </select>

        <label for="message">Nachricht</label>
        <textarea id="message" name="message" rows="6" required minlength="20" maxlength="1200"></textarea>

        <label class="consent"><input name="consent" type="checkbox" value="1" required> Ich stimme der Verarbeitung dieser Demo-Anfrage zu.</label>
        <button type="submit">Anfrage senden</button>
      </form>
    </section>
  </main>
</body>
</html>

