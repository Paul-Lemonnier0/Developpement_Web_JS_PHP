<?php

require('./IEmployee.php');

class Employee implements IEmployee{
    private $id;
    private $name;
    private $salary;
    private $age;

    public function __construct(int $id, string $name, float $salary, int $age){
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
        $this->age = $age;
    }

    public function getID(): int{
        return $this->id;
    }
    
    public function getName(): string{
        return $this->name;
    }

    public function getSalary(): float{
        return $this->salary;
    }

    public function getAge(): int{
        return $this->age;
    }

    public function setID(int $id){
        $this->id = $id;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setSalary(float $salary){
        $this->salary = $salary;
    }

    public function setAge(int $age){
        $this->age = $age;
    }

    public function __toString(): string{
        return "Employee [$this->id, $this->name, $this->salary, $this->age]";
    }
}

?>