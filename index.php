<?php

do {
    echo "
=== UNITY CARE CLI ===
1. Manage Doctors
2. Manage Patients
3. Manage Departments
4.Statistics
5. Exit
Choice: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            include "./menus/DoctorMenu.php";
            break;
        case 2:
            include "./menus/PatientMenu.php";
            break;
        case 3:
            include "./menus/DepartmentMenu.php";
            break;
        case 4:
            include "./menus/statistics.php";
            break;    
    }
} while ($choice != 4);
