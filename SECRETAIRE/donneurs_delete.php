
<?php
/*
require_once "auth.php";
require_role(['Secretaire','Admin']); //lena 5ater el secritaire wel admin 3andhoum l7a9 bech yod5lou lena 
require_once '../includes/connexion.php';



$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM donneurs WHERE id_donneur=?");
$stmt->execute([$id]);

header("Location: donneurs_list.php?deleted=1");
exit;
?>
*/

require_once __DIR__ . '/../includes/connexion.php';

// Vérification que l'ID est bien passé et que c'est une requête POST
if (isset($_POST['id']) && !empty($_POST['id']))//empty Retourne : true si la variable est vide, sinon fals
 {
    $id = $_POST['id'];

    // Vérification si l'ID est un nombre valide
    if (is_numeric($id)) {
        // Préparation de la requête DELETE
        $stmt = $pdo->prepare("DELETE FROM donneurs WHERE id_donneur = ?");
        $stmt->execute([$id]);

        // Redirection après suppression avec un message de confirmation
       header("Location: donneurs_list.php");
                        
        exit;
    } else {
        // Si l'ID n'est pas valide
        echo "ID invalide.";
    }
} else {
    // Si l'ID n'est pas passé dans la requête
    echo "Aucun ID trouvé.";
}
?>
