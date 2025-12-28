<?php
require_once "./config/Database.php";
require_once "./models/Doctor.php";

$db = Database::getConnection();

do {
    echo "
=== DOCTOR MENU ===
1. Add Doctor
2. List Doctors
3. Update Doctor
4. Delete Doctor
5. Back
Choice: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            echo "First name: "; $fn = trim(fgets(STDIN));
            echo "Last name: ";  $ln = trim(fgets(STDIN));
            echo "Specialization: "; $spec = trim(fgets(STDIN));
            echo "Phone: "; $ph = trim(fgets(STDIN));
            echo "Email: "; $em = trim(fgets(STDIN));
            echo "Department ID (or empty): ";
            $dept = trim(fgets(STDIN));
            $dept = $dept === "" ? null : (int)$dept;

            (new Doctor($db, $fn, $ln, $spec, $ph, $em, $dept))->save();
            break;

        case 2:
            foreach (Doctor::getAll($db) as $d) {
                echo "{$d['doctor_id']} - {$d['first_name']} {$d['last_name']} ({$d['specialization']})\n";
            }
            break;

        case 3:
            echo "Doctor ID: "; $id = (int) trim(fgets(STDIN));
            echo "First name: "; $fn = trim(fgets(STDIN));
            echo "Last name: "; $ln = trim(fgets(STDIN));
            echo "Specialization: "; $spec = trim(fgets(STDIN));
            echo "Phone: "; $ph = trim(fgets(STDIN));
            echo "Email: "; $em = trim(fgets(STDIN));
            echo "Department ID: "; $dept = (int) trim(fgets(STDIN));

            (new Doctor($db, $fn, $ln, $spec, $ph, $em, $dept))->update($id);
            break;

        case 4:
            echo "Doctor ID: ";
            Doctor::delete($db, (int) trim(fgets(STDIN)));
            break;
    }
} while ($choice != 5);
