<?php

class Department
{
    private PDO $db;
    private string $name;
    private string $location;

    public function __construct(PDO $db, string $name, string $location)
    {
        $this->db = $db;
        $this->name = $name;
        $this->location = $location;
    }

    public function save(): void
    {
        $sql = "INSERT INTO departements (departement_name, departement_location)
                VALUES (:name, :location)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":name" => $this->name,
            ":location" => $this->location
        ]);

        echo "Department added\n";
    }

    public static function getAll(PDO $db): array
    {
        return $db->query("SELECT * FROM departements")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(int $id): void
    {
        $sql = "UPDATE departements
                SET departement_name = :name,
                    departement_location = :location
                WHERE departement_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":name" => $this->name,
            ":location" => $this->location,
            ":id" => $id
        ]);

        echo " Department updated\n";
    }

    public static function delete(PDO $db, int $id): void
    {
        $stmt = $db->prepare("DELETE FROM departements WHERE departement_id = :id");
        $stmt->execute([":id" => $id]);
        echo "🗑 Department deleted\n";
    }
}
