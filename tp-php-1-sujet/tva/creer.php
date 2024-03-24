<?php

$articles = ["A", "B", "C" ,"D", "E", "F", "G", "H", "I", "J", "K"];
$taux_tva = [0.05, 0.10, 0.20];

// Création du tableau [..., "D" => ["Prix" => 22.71,"Taux" => 0.05], ...]

// function creer_prix_articles(string $article) : array {
function creer_prix_articles($article)
{
    global $taux_tva;
    $random_prix = rand(0, 10000) / 100;
    $random_tva_indice = rand(0, 2);
    $random_tva = $taux_tva[$random_tva_indice];
    return ["Prix" => $random_prix, "Taux" => $random_tva];
}



// initialisation de $prix_taux

$prix_taux = array_fill_keys($articles, []);
$prix_taux = array_map('creer_prix_articles', $prix_taux);
?>