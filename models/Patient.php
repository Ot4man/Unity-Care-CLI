<?php

class Patient
{
    private PDO $db;

    private string $first_name;
    private string $last_name;
    private string $phone;
    private string $email;
    private int $age;
    private string $gender;
    private string $address;

    public function __construct(
        PDO $db,
        string $first_name,
        string $last_name,
        string $phone,
        string $email,
        int $age,
        string $gender,
        string $address
    ) {
        $this->db = $db;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
        $this->age = $age;
        $this->gender = $gender;
        $this->address = $address;
    }

    // ADD PATIENT
    public function save(): void
    {
        $sql = "INSERT INTO patients 
        (first_name, last_name, age, gender, phone_number, email, adress)
        VALUES (:fn, :ln, :age, :gender, :phone, :email, :adress)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":fn" => $this->first_name,
            ":ln" => $this->last_name,
            ":age" => $this->age,
            ":gender" => $this->gender,
            ":phone" => $this->phone,
            ":email" => $this->email,
            ":adress" => $this->address
        ]);

        echo "✅ Patient added successfully\n";
    }

    // LIST PATIENTS
    public static function getAll(PDO $db): array
    {
        $stmt = $db->query("SELECT * FROM patients");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE PATIENT
    public function update(int $id): void
    {
        $sql = "UPDATE patients SET
            first_name = :fn,
            last_name = :ln,
            age = :age,
            gender = :gender,
            phone_number = :phone,
            email = :email,
            adress = :adress
            WHERE patient_id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ":fn" => $this->first_name,
            ":ln" => $this->last_name,
            ":age" => $this->age,
            ":gender" => $this->gender,
            ":phone" => $this->phone,
            ":email" => $this->email,
            ":adress" => $this->address,
            ":id" => $id
        ]);

        echo "✅ Patient updated successfully\n";
    }

    // DELETE PATIENT
    public static function delete(PDO $db, int $id): void
    {
        $stmt = $db->prepare("DELETE FROM patients WHERE patient_id = :id");
        $stmt->execute([":id" => $id]);

        echo "🗑 Patient deleted successfully\n";
    }
}
