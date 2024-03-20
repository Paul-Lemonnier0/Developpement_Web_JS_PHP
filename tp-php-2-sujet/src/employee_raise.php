<?php
declare(strict_types=1);

require 'employee_display.php';

require_once __DIR__ . '/../vendor/autoload.php';
use Acme\Employee;
echo "</br> Apres augmentation : </br>";

function employee_raise($e){

    if(gettype($e) == "object" and $e instanceof Employee){
        $e->setSalary($e->getSalary() * 1.05);
    }

    else throw new Exception("Ce n'est pas un employé : impossible de l'augmenter. </br>");
}

array_push($array_employees, "hello");

try{
    array_walk($array_employees, 'employee_raise');
}
catch(Exception $e) {
    $errorMessage = $e->getMessage();
    echo "Erreur : $errorMessage";
}

displayArrayEmployees($array_employees);

?>