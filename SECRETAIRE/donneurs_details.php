<?php
require_once "auth.php";
require_role(['Secretaire','Admin']);
require_once '../includes/connexion.php';

$id = $_POST['id'] ?? null;

if (!$id) {
    die("ID manquant.");
}

$stmt = $pdo->prepare("SELECT * FROM donneurs WHERE id_donneur = ?");
$stmt->execute([$id]);
$donneur = $stmt->fetch();

if (!$donneur) {
    die("Donneur introuvable");
}

$stmt2 = $pdo->prepare("SELECT * FROM dons WHERE id_donneur = ?");
$stmt2->execute([$id]);
$dons = $stmt2->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails Donneur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5c0cb 0%, #ff4d6d 100%);
            min-height: 100vh;
            font-family: 'Inter', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            border: 1px solid rgba(255,255,255,0.3);
            width: 100%;
            max-width: 800px;
        }

        h3, h4 {
            text-align: center;
            color: #8c0f32;
            margin-bottom: 1.5rem;
        }

        table th {
            background-color: #8c0f32;
            color: #fff;
        }

        .table td, .table th {
            vertical-align: middle;
        }
    </style>
</head>
<body>

<div class="glass-card">

    <h3>Détails du Donneur</h3>

    <div class="card p-3 mb-4 shadow-sm">
        <p><strong>Nom :</strong> <?= htmlspecialchars($donneur['nom_donneur']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($donneur['prenom_donneur']) ?></p>
        <p><strong>CIN :</strong> <?= htmlspecialchars($donneur['cin']) ?></p>
        <p><strong>Groupe :</strong> <?= htmlspecialchars($donneur['groupe_sanguin'] . " " . $donneur['rhesus']) ?></p>
        <p><strong>Ville :</strong> <?= htmlspecialchars($donneur['ville']) ?></p>
    </div>

    <h4>Historique des Dons</h4>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Don</th>
                <th>Centre</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dons as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['id_don']) ?></td>
                <td><?= htmlspecialchars($d['id_centre']) ?></td>
                <td><?= htmlspecialchars($d['statut']) ?></td>
                <td><?= htmlspecialchars($d['date_don']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
