<?php

require_once("employee_display.php");
require_once("Team.php");

$team = new Team($employees, $employees[0]);
echo $team;

?>