<?php

require_once("Employee.php");

class Team {
    private $manager;
    private $employees;

    public function __construct( array $employees, $manager = []){

        $this->employees = [];

        if($manager instanceof Employee){
            $this->manager = $manager;
        }

        foreach($employees as $e){
            if($e instanceof Employee){
                if($this->manager instanceof Employee){
                    if($this->manager->getID() != $e->getID()){
                        array_push($this->employees, $e);
                    }
                }

                else array_push($this->employees, $e);
            }
        }



    }


    public function __tostring(): string{
        $str = "";

        foreach($this->employees as $e){
            $str = "$str $e <br>";
        }

        if($this->manager instanceof Employee){
            $str = "$str $this->manager <br>";
            $subordonateNames = "subordinates : [";

            foreach($this->employees as $e){
                $employee_name = $e->getName();
                $subordonateNames = "$subordonateNames $employee_name ";
            }

            $subordonateNames = "$subordonateNames ] <br>";

            $str = "$str $subordonateNames";
        }

        return $str;
    }
}

?>