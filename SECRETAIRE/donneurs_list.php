<?php
require_once "auth.php";
require_role(['Secretaire','Admin']);
require_once '../includes/connexion.php';

$groupe = $_POST['groupe'] ?? "";
$ville = $_POST['ville'] ?? "";

$sql = "SELECT * FROM donneurs WHERE 1";
$params = [];

if ($groupe !== "") {
    $sql .= " AND groupe_sanguin = ?";
    $params[] = $groupe;
}

if ($ville !== "") {
    $sql .= " AND ville LIKE ?";
    $params[] = "%" . $ville . "%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$donneurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Donneurs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background: linear-gradient(135deg, rgba(233,200,205,0.8) 0%, rgba(235,87,129,0.8) 100%);
            min-height: 100vh;
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
        }

        h3 {
            text-align: center;
            color: #8c0f32;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff4d6d;
            box-shadow: 0 0 0 0.2rem rgba(255,77,109,0.2);
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

        .table-container {
            overflow-x: auto;
            border-radius: 12px;
        }

        .table {
            margin-bottom: 0;
            text-align: center;
            vertical-align: middle;
        }

        .table thead th {
            background: #8c0f32;
            color: white;
            padding: 15px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 12px;
        }

        .table tbody tr:hover {
            background-color: rgba(255,77,109,0.10);
        }

      .btn-info {
            background: #afedf7;
            color: white;
            border: none;
        }

        .btn-warning {
            background: #eee4ab;
            border: none;
            color: #333;
        }

        .btn-danger {
            background: #ffa9b2;
            border: none;
        }

        .btn-sm {
            font-weight: 600;
            margin: 2px;
        }

        .nombre-total {
            color: #8c0f32;
            font-weight: 700;
            margin-bottom: 15px;
        }

    </style>
</head>

<body>

<div class="glass-card">

    <h3>Liste des Donneurs</h3>

    <!-- Recherche -->
    <form method="POST" class="row g-3 mb-4">

        <div class="col-md-4">
            <select name="groupe" class="form-select">

                <option value="">-- Tous les groupes --</option>

                <option value="A" <?= $groupe == "A" ? "selected" : "" ?>>A</option>

                <option value="B" <?= $groupe == "B" ? "selected" : "" ?>>B</option>

                <option value="AB" <?= $groupe == "AB" ? "selected" : "" ?>>AB</option>

                <option value="O" <?= $groupe == "O" ? "selected" : "" ?>>O</option>

            </select>
        </div>

        <div class="col-md-4">
            <input type="text" name="ville" class="form-control"
                   placeholder="Rechercher par ville"
                   value="<?= htmlspecialchars($ville) ?>">
        </div>

        <div class="col-md-4 d-flex gap-2">

            <button type="submit" class="btn btn-primary flex-grow-1">
                Rechercher
            </button>

            <a href="donneurs_list.php" class="btn btn-secondary">
                Réinitialiser
            </a>

        </div>

    </form>

    <p class="nombre-total">
        Nombre de donneurs : <?= count($donneurs) ?>
    </p>

    <!-- Tableau -->
    <div class="table-container">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CIN</th>
                    <th>Groupe sanguin</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach ($donneurs as $d): ?>

                <tr>

                    <td><?= htmlspecialchars($d['id_donneur']) ?></td>

                    <td><?= htmlspecialchars($d['nom_donneur']) ?></td>

                    <td><?= htmlspecialchars($d['prenom_donneur']) ?></td>

                    <td><?= htmlspecialchars($d['cin']) ?></td>

                    <td>
                        <?= htmlspecialchars($d['groupe_sanguin'] . " " . $d['rhesus']) ?>
                    </td>

                    <td><?= htmlspecialchars($d['ville']) ?></td>

                    <td>

                        <!-- Détails -->
                        <form method="POST" action="donneurs_details.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($d['id_donneur']) ?>">
                            <button type="submit" class="btn btn-info btn-sm">
                                Détails
                            </button>
                        </form>

                        <!-- Supprimer -->
                        <form method="POST" action="donneurs_delete.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($d['id_donneur']) ?>">

                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce donneur ?')">
                                Supprimer
                            </button>
                        </form>

                        <!-- Modifier -->
                        <form method="POST" action="donneurs_edit.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($d['id_donneur']) ?>">

                            <button type="submit" class="btn btn-warning btn-sm">
                                Modifier
                            </button>
                        </form>

                    </td>

                </tr>

                <?php endforeach; ?>

                <?php if (count($donneurs) == 0): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Aucun donneur trouvé.
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>