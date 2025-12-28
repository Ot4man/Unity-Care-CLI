<?php
require_once "./config/Database.php";
require_once "./models/Department.php";

$db = Database::getConnection();

do {
    echo "
=== DEPARTMENT MENU ===
1. Add Department
2. List Departments
3. Update Department
4. Delete Department
5. Back
Choice: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            echo "Name: ";
            $name = trim(fgets(STDIN));
            echo "Location: ";
            $location = trim(fgets(STDIN));

            (new Department($db, $name, $location))->save();
            break;

        case 2:
            foreach (Department::getAll($db) as $d) {
                echo "{$d['departement_id']} - {$d['departement_name']} ({$d['departement_location']})\n";
            }
            break;

        case 3:
            echo "Department ID: ";
            $id = (int) trim(fgets(STDIN));
            echo "New Name: ";
            $name = trim(fgets(STDIN));
            echo "New Location: ";
            $location = trim(fgets(STDIN));

            (new Department($db, $name, $location))->update($id);
            break;

        case 4:
            echo "Department ID: ";
            Department::delete($db, (int) trim(fgets(STDIN)));
            break;
    }
} while ($choice != 5);
