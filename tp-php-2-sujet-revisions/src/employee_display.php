<?php

require_once("Employee.php");

$employees = [];
$e1 = new Employee(1, "Paul", 100000, 20);
$e2 = new Employee(2, "Kyllian", 50000, 20);
$e3 = new Employee(3, "Nicolas", 245200, 20);

$total_salaries = 0;
$avg_salary = 0;

array_push($employees, $e1);
array_push($employees, $e2);
array_push($employees, $e3);

function afficher_array($item){
    global $total_salaries;
    $total_salaries += $item->getSalary();

    echo "$item <br>";
}


function afficherEmployees($emps){
    array_walk($emps, 'afficher_array');
}

function afficherSalaireMoyen($emps){
    global $total_salaries;
    $avg_salary = round($total_salaries / count($emps));
    echo "Salaire moyen : $avg_salary <br>";
}



?>