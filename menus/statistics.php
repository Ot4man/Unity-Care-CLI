<?php

require_once "./config/Database.php";

$db = Database::getConnection();

do {
    echo "
=== STATISTICS MENU ===
1. Average age of patients
2. Total number of patients
3. Back
Choice: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {

        case 1:
            $sql = "SELECT AVG(age) AS average_age FROM patients";
            $stmt = $db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "\nAverage age of patients: "
                . number_format($result['average_age'], 2)
                . " years\n";
            break;

        case 2:
            $sql = "SELECT COUNT(*) AS total FROM patients";
            $stmt = $db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "\nTotal number of patients: {$result['total']}\n";
            break;

        case 3:
            echo "Returning to main menu...\n";
            break;

        default:
            echo "Invalid choice\n";
    }

} while ($choice != 3);
