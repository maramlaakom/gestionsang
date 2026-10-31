<?php
session_start();


if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: ../login.php"); 
    exit();
}


function require_role(array $roles) 
{
    if (!in_array($_SESSION['role'], $roles)) {
        http_response_code(403);
        die("Acces refuse : Vous n'avez pas le droit d'acceder à cette page.");
    }
}

?>

