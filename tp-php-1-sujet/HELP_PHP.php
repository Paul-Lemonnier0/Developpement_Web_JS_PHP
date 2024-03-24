<?php
$array = ["A" => "Bonjour", "B" => "Hola"];
$array_table = ["A" => array("Bonjour" => "Hello", "Au revoir" => "GoodBye"), 
            "B" => array("Bonjour" => "Hola", "Au revoir" => "Adios")];

//PARCOURS

echo "<br>PARCOURS : <br><br>";

function callback_walk($item, $key){
    echo "$key => $item <br>";
}

array_walk($array, 'callback_walk');

function callback_map($item){
    return "$item + MAP ";
}

$mapped_array = array_map('callback_map', $array);
array_walk($mapped_array, 'callback_walk');

echo "<br>ARRAY FILL KEYS : <br><br>";
$keys = ["1key1", "2key2", "3key3"];

$array_with_keys = array_fill_keys($keys, "value");
array_walk($array_with_keys, 'callback_walk');

//TRI

echo "<br>TRI <br><br>";

function tri_decroissant($a, $b){
    if($a == $b){
        return 0;
    }

    return ($a < $b) ? 1 : -1;
}

function tri_croissant($a, $b){
    echo "$a <br>";
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}

//TABLE

echo "<br>TABLE : <br><br>";

function generateHeaders($headers){
    echo "<tr>";
    array_walk($headers, 'create_header_cell');
    echo "</tr>";
}

function create_header_cell($header){
    echo "<th> $header </th>";
}

function generateRow($item, $key){
    echo "<tr>";
    create_cell($item["Bonjour"], "red");
    $item_row = [$item["Au revoir"]];

    array_walk($item_row, 'create_cell');
    echo "</tr>";
}

function create_cell($header, $backgroundColor){
    $bgColor = $backgroundColor ? $backgroundColor : "transparent";
    echo "<td style='background-color: $bgColor'> $header </td>";
}


function generer_tableau($array)
{
    $headers = ["Key", "Item"];
    echo "<table border>";
    generateHeaders($headers);
    array_walk($array, 'generateRow');
    echo "</table>";
}

generer_tableau($array_table);

//OTHER

//RANDOM
$random_number = rand(0, 100); //entre 0 et 100 compris

?>
