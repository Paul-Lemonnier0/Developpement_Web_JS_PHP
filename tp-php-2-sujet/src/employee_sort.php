<?php
declare(strict_types=1);

require 'employee_display.php';

require_once __DIR__ . '/../vendor/autoload.php';
use Acme\Employee;


echo "</br>";

function compareSalaire($a, $b) {
    if((gettype($a) == "object" and $a instanceof Employee) and (gettype($b) == "object" and $b instanceof Employee)){
        return $a->getSalary() - $b->getSalary();
    }

    else throw new Exception("Ce n'est pas un employé : impossible de le trier. </br>");
}

try{
    usort($array_employees, 'compareSalaire');
    displayArrayEmployees($array_employees);
}

catch(Exception $e){
    $msg = $e->getMessage();
    echo "Erreur dans le tri : $msg";
}


?>