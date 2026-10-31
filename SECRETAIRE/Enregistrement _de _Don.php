<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "auth.php";
require_role(['Secretaire','Admin']); //lena 5ater el secritaire wel admin 3andhoum l7a9 bech yod5lou lena 
require_once '../includes/connexion.php';

// Récupération donneurs
$stmtDonneurs = $pdo->prepare("SELECT id_donneur, cin FROM donneurs");
$stmtDonneurs->execute();
$donneurs = $stmtDonneurs->fetchAll(PDO::FETCH_ASSOC);

// Récupération centres
$stmtCentres = $pdo->prepare("SELECT id_centre FROM centres_collecte");
$stmtCentres->execute();
$centres = $stmtCentres->fetchAll(PDO::FETCH_ASSOC);

$message = "";

if (isset($_POST['submit'])) {
    $id_donneur = htmlspecialchars($_POST['donneur']);
    $id_centre = htmlspecialchars($_POST['centre']);

    $stmt = $pdo->prepare("INSERT INTO dons (id_donneur, id_centre, statut) VALUES (?, ?, 'EN STOCK')");
    
    if ($stmt->execute([$id_donneur, $id_centre])) {
        $message = '<div class="alert alert-success">Don enregistré avec succès !</div>';
    } else {
        $message = '<div class="alert alert-danger">Erreur lors de l\'enregistrement.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Enregistrement Don</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
     .glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(6px);
    }
   body {
        background: linear-gradient(135deg,rgba(255, 142, 164, 0.75) 0%, rgba(221, 89, 126, 0.85)100%);
        min-height: 100vh;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
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

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow p-4">
        <h3 class="class= text-center fw-bold mb-4 text-danger">Enregistrer un Don</h3>

        <?= $message ?>

        <form method="POST">

            <!-- Donneur -->
            <div class="mb-3">
                <label class="form-label">Donneur :</label>
                <select name="donneur" class="form-select" required>
                    <?php foreach ($donneurs as $d): ?>
                        <option value="<?= htmlspecialchars($d['id_donneur']) ?>">
                            Donneur #<?= htmlspecialchars($d['id_donneur']) ?> — CIN: <?= htmlspecialchars($d['cin']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Centre -->
            <div class="mb-3">
                <label class="form-label">Centre :</label>
                <select name="centre" class="form-select" required>
                    <?php foreach ($centres as $c): ?>
                        <option value="<?= htmlspecialchars($c['id_centre']) ?>">
                            Centre #<?= htmlspecialchars($c['id_centre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">
                Enregistrer Don
            </button>

        </form>
    </div>

</div>

</body>
</html>
