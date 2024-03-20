<?php

require_once("Employee.php");
require_once("employee_display.php");

function employee_raise($employee){
    if($employee instanceof Employee){
        $employee->setSalary($employee->getSalary() * 1.05);
    }

    else throw new Exception("Pas un employees <br>");
}


echo "Avant augmentation : <br>";
afficherEmployees($employees);

try{
    array_walk($employees, "employee_raise");
}

catch(Exception $e){
    $msg = $e->getMessage();
    echo "Erreur dans raise : $msg";
}

echo "Après augmentation : <br>";
afficherEmployees($employees);

echo "<br>";

$fake_array = [[], [], []];

echo "Avant augmentation : <br>";
afficherEmployees($employees);

try{
    array_walk($fake_array, "employee_raise");
}

catch(Exception $e){
    $msg = $e->getMessage();
    echo "Erreur dans raise : $msg";
}

echo "Après augmentation : <br>";
afficherEmployees($employees);