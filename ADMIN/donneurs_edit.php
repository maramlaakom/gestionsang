<?php
session_start();
require_once "auth.php";
require_role(['Secretaire','Admin']);
require_once '../includes/connexion.php';

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ID manquant.");
}

$id = $_POST['id'];

$stmt = $pdo->prepare("SELECT * FROM donneurs WHERE id_donneur = ?");
$stmt->execute([$id]);
$donneur = $stmt->fetch();

if (!$donneur) {
    die("Donneur introuvable avec ID: " . htmlspecialchars($id));
}

if (isset($_POST['nom_donneur'], $_POST['prenom_donneur'], $_POST['cin'], $_POST['groupe_sanguin'], $_POST['rhesus'], $_POST['ville'])) {

    $sql = "UPDATE donneurs 
            SET nom_donneur=?, prenom_donneur=?, cin=?, groupe_sanguin=?, rhesus=?, ville=?
            WHERE id_donneur=?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['nom_donneur'],
        $_POST['prenom_donneur'],
        $_POST['cin'],
        $_POST['groupe_sanguin'],
        $_POST['rhesus'],
        $_POST['ville'],
        $id
    ]);

    header("Location: donneurs_list.php?updated=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Donneur</title>

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

        .form-control:focus,
        .form-select:focus {
            border-color: #ff4d6d;
            box-shadow: 0 0 0 0.2rem rgba(255,77,109,0.2);
        }

    </style>
</head>

<body>

<div class="glass-card">

    <h3>Modifier Donneur</h3>

    <form method="POST" class="row g-3">

        <input type="hidden" name="id" value="<?= htmlspecialchars($donneur['id_donneur']) ?>">

        <div class="col-md-6">
            <label class="form-label">Nom</label>
            <input type="text" name="nom_donneur" class="form-control"
                   value="<?= htmlspecialchars($donneur['nom_donneur']) ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Prénom</label>
            <input type="text" name="prenom_donneur" class="form-control"
                   value="<?= htmlspecialchars($donneur['prenom_donneur']) ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">CIN</label>
            <input type="number" name="cin" class="form-control"
                   value="<?= htmlspecialchars($donneur['cin']) ?>" required>
        </div>

        <div class="col-md-6">
            <label class="form-label">Groupe sanguin</label>
            <select name="groupe_sanguin" class="form-select" required>

                <option value="A" <?= $donneur['groupe_sanguin']=="A" ? "selected" : "" ?>>A</option>

                <option value="B" <?= $donneur['groupe_sanguin']=="B" ? "selected" : "" ?>>B</option>

                <option value="AB" <?= $donneur['groupe_sanguin']=="AB" ? "selected" : "" ?>>AB</option>

                <option value="O" <?= $donneur['groupe_sanguin']=="O" ? "selected" : "" ?>>O</option>

            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Rhesus</label>
            <select name="rhesus" class="form-select" required>

                <option value="+" <?= $donneur['rhesus']=="+" ? "selected" : "" ?>>+</option>

                <option value="-" <?= $donneur['rhesus']=="-" ? "selected" : "" ?>>-</option>

            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Ville</label>
            <input type="text" name="ville" class="form-control"
                   value="<?= htmlspecialchars($donneur['ville']) ?>" required>
        </div>

        <div class="col-12 d-flex gap-2">

            <button type="submit" class="btn btn-primary flex-grow-1">
                Mettre à jour
            </button>

            <a href="donneurs_list.php" class="btn btn-secondary flex-grow-1">
                Retour à la liste
            </a>

        </div>

    </form>

</div>

</body>
</html>