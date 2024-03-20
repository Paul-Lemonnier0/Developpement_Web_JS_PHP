<?php

function js(string $code)
{
    echo "<script type=\"text/javascript\">$code</script>";
}

function console(string $str)
{
    js("console.log(\"" . htmlentities($str) . "\");");
}

function alert(string $str)
{
    js("alert(\"$str\");");
}

function displayException(PDOException $e)
{
    $msgError = "Erreur SQL : " . $e->getMessage();
    console($msgError);
    alert($msgError);
}
?>