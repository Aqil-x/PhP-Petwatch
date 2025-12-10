<?php
require_once __DIR__ . '/DB.php';

class SightingsDataSet
{
    private PDO $db;

    public function __construct()
    {
        $this->db = DB::conn();
    }


    public function fetchSightings(string $search = '', string $type = '', string $status = ''): array
    {
        $sql = "
            SELECT sightings.*, pets.name AS pet_name, pets.type, pets.status, users.username
            FROM sightings
            JOIN pets  ON sightings.pet_id = pets.id
            JOIN users ON sightings.user_id = users.id
            WHERE 1=1
        ";

        $params = [];

        if ($search !== '') {
            $sql .= " AND (pets.name LIKE :search OR users.username LIKE :search OR sightings.note LIKE :search)";
            $params[':search'] = "%$search%";
        }

        if ($type !== '') {
            $sql .= " AND pets.type = :type";
            $params[':type'] = $type;
        }

        if (!empty($status)) {
            $sql .= " AND pets.status = :status";
            $params[':status'] = $status;
        }

        $sql .= " ORDER BY sightings.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDistinctTypes(): array
    {
        return $this->db->query("SELECT DISTINCT type FROM pets ORDER BY type ASC")
            ->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getDistinctStatuses(): array
    {
        return $this->db->query("SELECT DISTINCT status FROM pets ORDER BY status ASC")
            ->fetchAll(PDO::FETCH_COLUMN);
    }


    public function addSighting(
        int $pet_id,
        int $user_id,
        string $note,
        ?float $latitude,
        ?float $longitude,
        ?string $imagePath
    ): void {

        $sql = "
            INSERT INTO sightings (pet_id, user_id, note, latitude, longitude, image_path, created_at)
            VALUES (:pet_id, :user_id, :note, :lat, :lon, :image_path, datetime('now'))
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':pet_id'     => $pet_id,
            ':user_id'    => $user_id,
            ':note'       => $note,
            ':lat'        => $latitude,
            ':lon'        => $longitude,
            ':image_path' => $imagePath
        ]);
    }
}
