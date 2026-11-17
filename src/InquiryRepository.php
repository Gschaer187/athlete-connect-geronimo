<?php

declare(strict_types=1);

/**
 * Verantwortlich für: Anfragen in der Datenbank speichern und lesen.
 *
 * Ein "Repository" ist die einzige Stelle im Projekt, die SQL für Anfragen kennt.
 */
final class InquiryRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    /**
     * Speichert eine Anfrage.
     *
     * Prepared Statement: Das SQL enthält nur Platzhalter (:name, :email ...).
     * Die echten Werte werden separat übergeben. So kann eine Eingabe wie
     * "'; DROP TABLE inquiries; --" niemals als SQL-Befehl ausgeführt werden.
     *
     * @param array{name: string, organisation: string, email: string, request_type: string, message: string} $values
     */
    public function save(array $values): void
    {
        $statement = $this->pdo->prepare(
            'INSERT INTO inquiries
                (name, organisation, email, request_type, message, created_at)
             VALUES
                (:name, :organisation, :email, :request_type, :message, :created_at)'
        );

        $statement->execute([
            'name'         => $values['name'],
            'organisation' => $values['organisation'],
            'email'        => $values['email'],
            'request_type' => $values['request_type'],
            'message'      => $values['message'],
            'created_at'   => gmdate('c'), // Zeitpunkt setzt der Server, nicht das Formular
        ]);
    }

    /** @return list<array<string, mixed>> neueste Anfragen zuerst */
    public function latest(int $limit = 20): array
    {
        $statement = $this->pdo->prepare('SELECT * FROM inquiries ORDER BY id DESC LIMIT :limit');
        $statement->bindValue('limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
