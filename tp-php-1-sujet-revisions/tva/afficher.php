<?php
// Calcul et génération taxe et coût TTC par article sous forme de ligne de tableau HTML
// $value : valeur de type array d'un élément du tableau $prix_taux
// $key : clé de type string d'un élément du tableau $prix_taux
// $param : paramètre additionnel de type string (couleur de fond CSS)
//

// Génération de tableau HTML
//

function create_header_cell($header){
    if($header == "Taux T.V.A."){
        echo "<th> <a href='#'>$header</a></th>";
    }

    else echo "<th> $header </th>";
}

function create_cell($header, $backgroundColor){
    echo "<td style='background-color: $backgroundColor'> $header </td>";
}

function generateHeaders($headers){
    echo "<tr>";
    array_walk($headers, 'create_header_cell');
    echo "</tr>";
}

function taxe($article, $article_name){
    echo "<tr>";

    $taxe = round($article["Prix"] * $article["Taux"], 2);
    $cout = round($taxe + $article["Prix"], 2);

    $article_row = [$article_name, $article["Prix"], $article["Taux"], $taxe];

    array_walk($article_row, 'create_cell');
    create_cell($cout, "red");
    echo "</tr>";
}



function generer_tableau($array)
{
    $headers = ["Article", "Prix", "Taux T.V.A.", "Taxe", "Coût T.T.C."];
    echo "<table>";
    generateHeaders($headers);
    array_walk($array, 'taxe');
    echo "</table>";
}

// tri du tableau

function tri_decroissant_prix($a, $b){
    if($a["Prix"] == $b["Prix"]){
        return 0;
    }

    return ($a["Prix"] < $b["Prix"]) ? 1 : -1;
}

function tri_croissant_tva($a, $b){
    if ($a["Taux"] == $b["Taux"]) {
        return tri_decroissant_prix($a, $b);
    }
    return ($a["Taux"] < $b["Taux"]) ? -1 : 1;
}

uasort($prix_taux, "tri_croissant_tva");

// Affichage du tableau
generer_tableau($prix_taux);
?>