<?php
require ("connexpdo.inc.php");
require_once ("js.php");

try {
    $objdb = connexpdo("voitures");
} catch (PDOException $e) {
    displayException($e);
}
?>