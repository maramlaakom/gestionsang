<?php
require_once '../includes/connexion.php';

$sql = "SELECT id_utilisateur, mot_de_passe FROM utilisateurs";
$stmt = $pdo->query($sql);

while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $plain_password = $user['mot_de_passe']; 

    $hashed = password_hash($plain_password, PASSWORD_DEFAULT);

    $update = $pdo->prepare("UPDATE utilisateurs SET mot_de_passe_hash = :hash WHERE id_utilisateur = :id");
    $update->execute([
        ':hash' => $hashed,
        ':id'   => $user['id_utilisateur']
    ]);

    echo "Utilisateur ID ".$user['id_utilisateur']." — OK ✔<br>";
}

echo "<br>Tous les mots de passe ont été hashés.";
