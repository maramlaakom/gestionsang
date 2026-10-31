<?php
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: login.php");//ken mawjoud cv snn bech yeb3thou ya3mel login
    exit;
}


function require_role(array $roles) {
   
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $roles)) {
        
        http_response_code(403);
        die("Acces. Vous n'avez pas le droit d'acceder à cette page.");
    }
}
?>
