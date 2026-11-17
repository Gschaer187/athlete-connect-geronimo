<!doctype html>
<html lang="de-CH">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Geronimo Schär · Goalie · Athlete Connect</title>
  <meta name="description" content="Geronimo Schär, Goalie bei HC Davos U18-Elit. Anfragen für Sponsoring, Material, Medien, Clubs und Events.">
  <link rel="stylesheet" href="assets/app.css">
</head>
<body>
  <!-- Sprunglink: Tastatur-Nutzer kommen direkt zum Formular -->
  <a class="skip-link" href="#anfrage">Direkt zum Anfrageformular</a>

  <header class="site-header">
    <span class="brand">Geronimo<span aria-hidden="true">·</span>Schär</span>
    <nav aria-label="Seitennavigation">
      <a href="#profil">Profil</a>
      <a href="#angebot">Angebot</a>
      <a href="#anfrage" class="nav-cta">Anfrage</a>
    </nav>
  </header>

  <main>
    <!-- ========== 1. PROFIL ========== -->
    <section id="profil" class="hero" aria-labelledby="hero-title">
      <p class="eyebrow">Goalie · HC Davos U18-Elit</p>
      <h1 id="hero-title">Geronimo<br><span>Schär</span></h1>
      <p class="lead">
        Seit neun Jahren im Eishockey, jetzt in der zweiten Saison beim HCD.
        Mein Ziel ist der Schritt nach Nordamerika. Dafür suche ich Partner, die den Weg mitgehen.
      </p>

      <dl class="facts">
        <div><dt>Position</dt><dd>Goalie</dd></div>
        <div><dt>Team</dt><dd>HC Davos U18-Elit</dd></div>
        <div><dt>Grösster Erfolg</dt><dd>Schweizer Meister U16-Elit 2026</dd></div>
        <div><dt>Ziel</dt><dd>Nordamerika</dd></div>
      </dl>
    </section>

    <!-- ========== 2. ANGEBOT ========== -->
    <section id="angebot" class="offer" aria-labelledby="offer-title">
      <p class="eyebrow">Was ich biete</p>
      <h2 id="offer-title">Partnerschaft auf und neben dem Eis</h2>
      <ul class="offer-list">
        <li>
          <h3>Sichtbarkeit</h3>
          <p>Ihr Logo auf Ausrüstung und in meinen Social-Media-Beiträgen.</p>
        </li>
        <li>
          <h3>Content</h3>
          <p>Als angehender Mediamatiker fotografiere und filme ich selbst. Sie erhalten Bilder aus dem Hockeyalltag.</p>
        </li>
        <li>
          <h3>Präsenz</h3>
          <p>Auftritte an Events, Autogrammstunden oder Camps nach Absprache.</p>
        </li>
      </ul>
    </section>

    <!-- ========== 3. ANFRAGE ========== -->
    <section id="anfrage" class="contact" aria-labelledby="contact-title">
      <p class="eyebrow">Kontakt</p>
      <h2 id="contact-title">Anfrage senden</h2>
      <p class="contact-intro">Ich antworte in der Regel innert einer Woche. Felder mit <span class="req">Pflicht</span> müssen ausgefüllt sein.</p>

      <?php if ($sent): ?>
        <!-- role="status": Screenreader lesen die Meldung automatisch vor -->
        <div class="notice" role="status">
          Danke! Ihre Anfrage ist angekommen. Ich melde mich in der Regel innert einer Woche.
        </div>
      <?php endif; ?>

      <?php if ($requestFailed): ?>
        <div class="notice notice--error" role="alert">
          Bitte füllen Sie alle Pflichtfelder aus.
        </div>
      <?php endif; ?>

      <form method="post" class="inquiry-form">

        <!-- Gruppe 1: Wer fragt an? -->
        <fieldset>
          <legend>Über Sie</legend>

          <div class="field">
            <label for="name">Name <span class="req">Pflicht</span></label>
            <input id="name" name="name" type="text" required maxlength="80"
                   autocomplete="name" aria-describedby="name-error"
                   value="<?= e($values['name']) ?>">
            <p id="name-error" class="field-error" aria-live="polite"></p>
          </div>

          <div class="field">
            <label for="organisation">Firma oder Organisation <span class="opt">optional</span></label>
            <input id="organisation" name="organisation" type="text" maxlength="100"
                   autocomplete="organization" aria-describedby="organisation-help organisation-error"
                   value="<?= e($values['organisation']) ?>">
            <p id="organisation-help" class="field-help">Bei Sponsoring- und Materialanfragen hilfreich.</p>
            <p id="organisation-error" class="field-error" aria-live="polite"></p>
          </div>

          <div class="field">
            <label for="email">Geschäftliche E-Mail <span class="req">Pflicht</span></label>
            <input id="email" name="email" type="email" required maxlength="160"
                   autocomplete="email" inputmode="email"
                   aria-describedby="email-help email-error"
                   value="<?= e($values['email']) ?>">
            <p id="email-help" class="field-help">An diese Adresse geht meine Antwort.</p>
            <p id="email-error" class="field-error" aria-live="polite"></p>
          </div>
        </fieldset>

        <!-- Gruppe 2: Worum geht es? -->
        <fieldset>
          <legend>Ihre Anfrage</legend>

          <div class="field">
            <label for="request_type">Art der Anfrage <span class="req">Pflicht</span></label>
            <select id="request_type" name="request_type" required aria-describedby="request_type-error">
              <option value="">Bitte wählen</option>
              <?php foreach ($requestTypes as $typeValue => $typeLabel): ?>
                <option value="<?= e($typeValue) ?>" <?= $values['request_type'] === $typeValue ? 'selected' : '' ?>>
                  <?= e($typeLabel) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <p id="request_type-error" class="field-error" aria-live="polite"></p>
          </div>

          <div class="field">
            <label for="message">Nachricht <span class="req">Pflicht</span></label>
            <textarea id="message" name="message" rows="6" required minlength="20" maxlength="1200"
                      aria-describedby="message-help message-error"><?= e($values['message']) ?></textarea>
            <p id="message-help" class="field-help">Was möchten Sie anbieten oder anfragen, und für welchen Zeitraum? 20 bis 1200 Zeichen.</p>
            <p id="message-error" class="field-error" aria-live="polite"></p>
          </div>
        </fieldset>

        <!-- Gruppe 3: Zustimmung -->
        <div class="field">
          <label class="consent">
            <input id="consent" name="consent" type="checkbox" value="1" required aria-describedby="consent-error">
            <span>Ich bin einverstanden, dass meine Angaben zur Bearbeitung dieser Anfrage gespeichert werden. <span class="req">Pflicht</span></span>
          </label>
          <p id="consent-error" class="field-error" aria-live="polite"></p>
        </div>

        <button type="submit">Anfrage senden</button>
      </form>
    </section>
  </main>

  <footer class="site-footer">
    <p>© 2026 Geronimo Schär · M307 Athlete Connect (Schulprojekt)</p>
  </footer>

  <script src="assets/app.js" defer></script>
</body>
</html>
