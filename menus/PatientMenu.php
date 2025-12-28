<?php
require_once "./config/Database.php";
require_once "./models/Patient.php";

$db = Database::getConnection();

do {
    echo "
=== PATIENT MENU ===
1. Add Patient
2. List Patients
3. Update Patient
4. Delete Patient
5. Back
Choice: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {

        case 1:
            echo "First name: ";
            $fn = trim(fgets(STDIN));

            echo "Last name: ";
            $ln = trim(fgets(STDIN));

            echo "Phone: ";
            $ph = trim(fgets(STDIN));

            echo "Email: ";
            $em = trim(fgets(STDIN));

            echo "Age: ";
            $age = (int) trim(fgets(STDIN));

            echo "Gender (male/female): ";
            $gender = trim(fgets(STDIN));

            echo "Address: ";
            $address = trim(fgets(STDIN));

            $patient = new Patient(
                $db,
                $fn,
                $ln,
                $ph,
                $em,
                $age,
                $gender,
                $address
            );

            $patient->save();
            break;

        case 2:
            $patients = Patient::getAll($db);
            foreach ($patients as $p) {
                echo "{$p['patient_id']} - {$p['first_name']} {$p['last_name']} | {$p['phone_number']}\n";
            }
            break;

        case 3:
            echo "Patient ID to update: ";
            $id = (int) trim(fgets(STDIN));

            echo "New First name: ";
            $fn = trim(fgets(STDIN));

            echo "New Last name: ";
            $ln = trim(fgets(STDIN));

            echo "New Phone: ";
            $ph = trim(fgets(STDIN));

            echo "New Email: ";
            $em = trim(fgets(STDIN));

            echo "New Age: ";
            $age = (int) trim(fgets(STDIN));

            echo "New Gender: ";
            $gender = trim(fgets(STDIN));

            echo "New Address: ";
            $address = trim(fgets(STDIN));

            $patient = new Patient(
                $db,
                $fn,
                $ln,
                $ph,
                $em,
                $age,
                $gender,
                $address
            );

            $patient->update($id);
            break;

        case 4:
            echo "Patient ID to delete: ";
            $id = (int) trim(fgets(STDIN));
            Patient::delete($db, $id);
            break;

        case 5:
            break;

        default:
            echo "❌ Invalid choice\n";
    }

} while ($choice != 5);
