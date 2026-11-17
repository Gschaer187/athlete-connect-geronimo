/* ==========================================================
   Progressive Verbesserung für das Anfrageformular
   - Ohne JavaScript funktioniert die normale Browser-Validierung.
   - Mit JavaScript zeigen wir verständliche Meldungen direkt beim Feld.
   - WICHTIG: Das ist nur Komfort. Die echte Prüfung macht der Server (Etappe 4).
   ========================================================== */

const form = document.querySelector('.inquiry-form');

if (form) {
  // Eigene Meldungen statt der Browser-Bubbles verwenden
  form.setAttribute('novalidate', '');

  // Verständliche Texte pro Feld und Fehlerart
  const messages = {
    name: { valueMissing: 'Bitte geben Sie Ihren Namen ein.' },
    email: {
      valueMissing: 'Bitte geben Sie eine E-Mail-Adresse ein.',
      typeMismatch: 'Die E-Mail-Adresse braucht ein @ und eine Domain, z. B. name@firma.ch.',
    },
    request_type: { valueMissing: 'Bitte wählen Sie die Art der Anfrage.' },
    message: {
      valueMissing: 'Bitte schreiben Sie eine Nachricht.',
      tooShort: 'Die Nachricht braucht mindestens 20 Zeichen.',
    },
    consent: { valueMissing: 'Bitte bestätigen Sie die Zustimmung.' },
  };

  // Prüft ein Feld und zeigt die passende Meldung an
  function validateField(field) {
    const errorBox = document.getElementById(`${field.name}-error`);
    if (!errorBox) return true;

    const validity = field.validity;
    let text = '';

    if (!validity.valid) {
      const fieldMessages = messages[field.name] || {};
      const problem = Object.keys(fieldMessages).find((key) => validity[key]);
      text = problem ? fieldMessages[problem] : field.validationMessage;
    }

    errorBox.textContent = text;
    field.setAttribute('aria-invalid', text ? 'true' : 'false');
    return text === '';
  }

  const fields = form.querySelectorAll('input, select, textarea');

  // Fehler entfernen, sobald die Person korrigiert
  fields.forEach((field) => {
    field.addEventListener('input', () => {
      if (field.getAttribute('aria-invalid') === 'true') validateField(field);
    });
    field.addEventListener('change', () => {
      if (field.getAttribute('aria-invalid') === 'true') validateField(field);
    });
  });

  form.addEventListener('submit', (event) => {
    let firstInvalid = null;

    fields.forEach((field) => {
      const ok = validateField(field);
      if (!ok && !firstInvalid) firstInvalid = field;
    });

    if (firstInvalid) {
      event.preventDefault();
      firstInvalid.focus(); // Fokus springt zum ersten Fehler
    }
  });
}
