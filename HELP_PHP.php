<?php
$array = ["A" => "Bonjour", "B" => "Hola"];

function callback($item, $key){
    echo "$key => $item";
}

array_walk($array, 'callback');
?>
