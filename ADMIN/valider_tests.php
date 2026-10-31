<?php

require_once '../includes/connexion.php';

require_once '../Medcine/auth.php'; 
require_role(["Admin", "Medecin"]);



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/../includes/connexion.php';

$message = "";


$stmt = $pdo->prepare("SELECT id_don FROM dons WHERE statut='EN STOCK'");
$stmt->execute();
$dons = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['valider'])){

    $id_don = htmlspecialchars($_POST['id_don']);
    $est_conforme = (int) $_POST['est_conforme'];

 
    $check = $pdo->prepare("SELECT id_test FROM tests_don WHERE id_don=?");
    $check->execute([$id_don]);

    if($check->rowCount() > 0){

        $stmt = $pdo->prepare("UPDATE tests_don SET est_conforme=? WHERE id_don=?");
        $stmt->execute([$est_conforme, $id_don]);

        $message = "<div class='alert alert-primary'>Test mis à jour pour ce don.</div>";

    } else {

        $stmt = $pdo->prepare("INSERT INTO tests_don (id_don, est_conforme) VALUES (?, ?)");
        $stmt->execute([$id_don, $est_conforme]);

        $message = "<div class='alert alert-success'>Test enregistré pour ce don.</div>";
    }

    
    $statut = $est_conforme ? 'UTILISÉ' : 'REJETÉ';
    $stmt2 = $pdo->prepare("UPDATE dons SET statut=? WHERE id_don=?");
    $stmt2->execute([$statut, $id_don]);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Validation des Tests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg,rgba(255, 142, 164, 0.75) 0%, rgba(221, 89, 126, 0.85)100%);
        min-height: 100vh;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .custom-card {
         background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(6px);
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(199, 195, 196, 0.19);
        border: 1px solid rgba(185, 173, 173, 0.3);
    }

    .btn-primary {
        background: linear-gradient(120deg, #ff4d6d, #b11b45);
        border: none;
    }
    .btn-primary:hover {
        opacity: 0.85;
    }
</style>

    

</head>

<body >

<div class="container">
    <div class="custom-card p-4 col-md-6 col-lg-4 mx-auto">

        <h3 class="text-center mb-3 text-danger fw-bold">Valider un Test</h3>

        <?= $message ?? "" ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Don :</label>
                <select name="id_don" class="form-select" required>
                    <option value="">-- Choisir un don --</option>
                    <?php foreach($dons as $d): ?>
                        <option value="<?= htmlspecialchars($d['id_don']) ?>">
                            Don n°<?= htmlspecialchars($d['id_don']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Résultat test :</label>
                <input type="text" name="resultat" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Conforme :</label>
                <select name="est_conforme" class="form-select">
                    <option value="1">Oui</option>
                    <option value="0">Non</option>
                </select>
            </div>

            <button type="submit" name="valider" class="btn btn-primary w-100 mt-3">
                Valider Test
            </button>

        </form>

    </div>
</div>


</body>
</html>
