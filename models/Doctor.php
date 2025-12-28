<?php

class Doctor
{
    private PDO $db;
    private string $first_name;
    private string $last_name;
    private string $specialization;
    private string $phone;
    private string $email;
    private ?int $dept_id;

    public function __construct(
        PDO $db,
        string $first_name,
        string $last_name,
        string $specialization,
        string $phone,
        string $email,
        ?int $dept_id
    ) {
        $this->db = $db;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->specialization = $specialization;
        $this->phone = $phone;
        $this->email = $email;
        $this->dept_id = $dept_id;
    }

    public function save(): void
    {
        $sql = "INSERT INTO doctors
        (first_name, last_name, specialization, phone_number, email, id_departement)
        VALUES (:fn, :ln, :spec, :phone, :email, :dept)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":fn" => $this->first_name,
            ":ln" => $this->last_name,
            ":spec" => $this->specialization,
            ":phone" => $this->phone,
            ":email" => $this->email,
            ":dept" => $this->dept_id
        ]);

        echo "Doctor added\n";
    }

    public static function getAll(PDO $db): array
    {
        return $db->query("SELECT * FROM doctors")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(int $id): void
    {
        $sql = "UPDATE doctors SET
            first_name = :fn,
            last_name = :ln,
            specialization = :spec,
            phone_number = :phone,
            email = :email,
            id_departement = :dept
            WHERE doctor_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":fn" => $this->first_name,
            ":ln" => $this->last_name,
            ":spec" => $this->specialization,
            ":phone" => $this->phone,
            ":email" => $this->email,
            ":dept" => $this->dept_id,
            ":id" => $id
        ]);

        echo "Doctor updated\n";
    }

    public static function delete(PDO $db, int $id): void
    {
        $stmt = $db->prepare("DELETE FROM doctors WHERE doctor_id = :id");
        $stmt->execute([":id" => $id]);
        echo "Doctor deleted\n";
    }
}
