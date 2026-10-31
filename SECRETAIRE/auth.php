<?php
session_start();

// bech ychouf ken l'utilisateur mawjoud wele lee fel session
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: login.php");//ken mawjoud cv snn bech yeb3thou ya3mel login
    exit;
}

// Vérifier les rôles autorisés (bech ychouf 3andou role wela lee)
function require_role(array $roles) 
{
    if (!in_array($_SESSION['role'], $roles)) {
        http_response_code(403);
        die("Acces refuse");
    }
}
?>
