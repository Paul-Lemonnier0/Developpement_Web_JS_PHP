<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
use Acme\Employee;

echo "Avant augmentation : </br>";

$array_employees = array(
    new Employee(1, "Nicolas", 2000, 15),
    new Employee(2, "Kyllian", 2500, 25),
    new Employee(3, "Paul", 1500, 20)
);
$array_employees = array(
    new Employee(1, "Nicolas", 2000, 15),
    new Employee(2, "Kyllian", 2500, 25),
    new Employee(3, "Paul", 1500, 20)
);
$sommeSalaire = 0;
var_dump($array_employees);


function mapEmployees($e){
    if(true){
        global $sommeSalaire;
        echo $e;
        $sommeSalaire += $e->getSalary();    
    }

    else throw new Exception("Ce n'est pas un employé : impossible de l'afficher </br>");
}

function displayArrayEmployees($array){
    try{
        global $sommeSalaire;
        array_walk($array, 'mapEmployees');
        $moyenneSalaire = $sommeSalaire/3;
    
        echo "Moyenne des salaires : $moyenneSalaire </br>";
    }

    catch(Exception $e) {
        $errorMessage = $e->getMessage();
        echo "Erreur : $errorMessage";
    }
}

displayArrayEmployees($array_employees);
?>