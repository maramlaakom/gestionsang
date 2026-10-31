
<?php

require_once "auth.php";
require_role(['Secretaire','Admin']); 
require_once '../includes/connexion.php';






require_once __DIR__ . '/../includes/connexion.php';

if (isset($_POST['id']) && !empty($_POST['id']))
 {
    $id = $_POST['id'];

    if (is_numeric($id)) {
        $stmt = $pdo->prepare("DELETE FROM donneurs WHERE id_donneur = ?");
        $stmt->execute([$id]);

        header("Location: donneurs_list.php?deleted=1");
        exit;
    } else {
        echo "ID invalide.";
    }
} else {
    echo "Aucun ID trouvé.";
}
?>
