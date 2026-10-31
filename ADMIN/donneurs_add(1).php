<?php
session_start();
require_once "auth.php";
require_role(['Secretaire','Admin']);
require_once '../includes/connexion.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $ville = $_POST['ville'];

    $cin = $_POST['cin'];
    $groupe = $_POST['groupe_sanguin'];
    $rhesus = $_POST['rhesus'];

    $sql = "INSERT INTO donneurs 
    (nom_donneur, prenom_donneur, cin, groupe_sanguin, rhesus, ville)
    VALUES 
    (:nom_donneur, :prenom_donneur, :cin, :groupe_sanguin, :rhesus, :ville)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nom_donneur', $nom);
    $stmt->bindParam(':prenom_donneur', $prenom);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':cin', $cin);
    $stmt->bindParam(':groupe_sanguin', $groupe);
    $stmt->bindParam(':rhesus', $rhesus);

    if ($stmt->execute()) {
        $message = "Nouveau donneur ajouté avec succès !";
    } else {
        $message = "Échec de l'insertion !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter Donneur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, rgba(233,200,205,0.8) 0%, rgba(235,87,129,0.8) 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            font-family: 'Inter', Arial, sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            border: 1px solid rgba(255,255,255,0.3);
            width: 100%;
            max-width: 700px;
        }

        h3 {
            text-align: center;
            color: #8c0f32;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: linear-gradient(120deg, #ff4d6d, #b11b45);
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            transition: 0.2s;
        }

        .btn-secondary {
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="glass-card">

    <h3>Ajouter un Donneur</h3>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="row g-3">

        <div class="col-md-6">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" required class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom" required class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">CIN</label>
            <input type="text" name="cin" required class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Ville</label>
            <input type="text" name="ville" required class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Groupe sanguin</label>
            <select name="groupe_sanguin" required class="form-select">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Rhesus</label>
            <select name="rhesus" required class="form-select">
                <option value="+">+</option>
                <option value="-">-</option>
            </select>
        </div>

        <div class="col-12 d-flex gap-2">

            <button type="submit" class="btn btn-primary flex-grow-1">
                Ajouter
            </button>

            <a href="donneurs_list.php" class="btn btn-secondary flex-grow-1">
                Retour à la liste
            </a>

        </div>

    </form>

</div>

</body>
</html>
