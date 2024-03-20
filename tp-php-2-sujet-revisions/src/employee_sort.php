<?php

require_once("Employee.php");
require_once("employee_display.php");

function tri_croissant_salaire($a, $b){
    if ($a->getSalary() == $b->getSalary()) {
        return 0;
    }
    return ($a->getSalary() < $b->getSalary()) ? -1 : 1;
}

uasort($employees, 'tri_croissant_salaire');
var_dump($employees);
