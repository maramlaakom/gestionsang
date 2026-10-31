<?php
session_start();

require_once __DIR__ . '/../includes/connexion.php';

$errors = [];

$stats = [
    'total_donneurs' => 0,
    'total_centres' => 0,
    'total_dons' => 0,
    'dons_stock' => 0
];

$stock_par_groupe = [];
$alertes_critiques = [];

try {

    $sql_stats = "
        SELECT
            (SELECT COUNT(*) FROM donneurs) AS total_donneurs,
            (SELECT COUNT(*) FROM centres_collecte) AS total_centres,
            (SELECT COUNT(*) FROM dons) AS total_dons,
            (SELECT COUNT(*) FROM dons WHERE statut = 'EN STOCK') AS dons_stock
    ";

    $stats = $pdo->query($sql_stats)->fetch(PDO::FETCH_ASSOC);


    $sql_stock = "
        SELECT
            CONCAT(d.groupe_sanguin, d.rhesus) AS groupe_complet,
            COUNT(t.id_don) AS quantite_stock
        FROM dons t
        INNER JOIN donneurs d
            ON t.id_donneur = d.id_donneur
        WHERE t.statut = 'EN STOCK'
        GROUP BY d.groupe_sanguin, d.rhesus
        ORDER BY quantite_stock DESC
    ";

    $stock_par_groupe = $pdo->query($sql_stock)->fetchAll(PDO::FETCH_ASSOC);


    $sql_alertes = "
        SELECT groupe_sanguin, niveau_alerte
        FROM besoins
        WHERE niveau_alerte IN ('URGENT', 'CRITIQUE')
        ORDER BY FIELD(niveau_alerte, 'CRITIQUE', 'URGENT')
    ";

    $alertes_critiques = $pdo->query($sql_alertes)->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {

    $errors[] = "Erreur de base de données : " . $e->getMessage();

}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tableau de Bord - Gestion Don de Sang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            background: linear-gradient(135deg, rgba(233,200,205,0.8) 0%, rgba(235,87,129,0.8) 100%);
            min-height: 100vh;
            padding: 2rem;
            font-family: 'Inter', Arial, sans-serif;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            margin-bottom: 25px;
        }

        h2 {
            text-align: center;
            color: #8c0f32;
            font-weight: 700;
            margin-bottom: 30px;
        }

        h3 {
            color: #8c0f32;
            font-weight: 700;
            margin-bottom: 20px;
        }

       

        .stat-card {
            background: rgba(255,255,255,0.90);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            border-left: 6px solid #b11b45;
            transition: 0.3s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.18);
        }

        .stat-card h4 {
            color: #8c0f32;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-card p {
            color: #666;
            font-weight: 600;
            margin: 0;
        }

        .stat-icon {
            font-size: 30px;
            margin-bottom: 10px;
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
        }

        .table tbody td {
            padding: 13px;
        }

        .table tbody tr:hover {
            background-color: rgba(255,77,109,0.10);
        }


        .progress {
            height: 12px;
            border-radius: 10px;
            background: #f1d5dd;
        }

        .progress-bar {
            background: linear-gradient(120deg, #ff4d6d, #b11b45);
            border-radius: 10px;
        }

        .badge-groupe {
            background: #8c0f32;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 600;
        }


        .alerte-card {
            border-radius: 15px;
            padding: 20px;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(0,0,0,0.10);
            height: 100%;
        }

        .alerte-critique {
            background: #ffe0e5;
            border-left: 6px solid #dc3545;
            color: #8c0f32;
        }

        .alerte-urgent {
            background: #fff0d5;
            border-left: 6px solid #ff9800;
            color: #8a5000;
        }

        .alerte-success {
            background: #d9f5e5;
            color: #146c43;
            border-left: 6px solid #198754;
            padding: 18px;
            border-radius: 12px;
        }

        .section-title {
            border-bottom: 2px solid #f3b5c4;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .dashboard-card {
                padding: 1rem;
            }
        }

    </style>

</head>

<body>

<div class="container-fluid">
    <h2>🩸 Tableau de Bord - Gestion Don de Sang</h2>


 
    <?php if (!empty($errors)): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($errors[0]) ?>
        </div>

    <?php endif; ?>


    <div class="row g-4 mb-4">

        <div class="col-md-3 col-sm-6">

            <div class="stat-card">

                <div class="stat-icon">👥</div>

                <h4>
                    <?= htmlspecialchars($stats['total_donneurs'] ?? 0) ?>
                </h4>

                <p>Total Donneurs</p>

            </div>

        </div>


        <div class="col-md-3 col-sm-6">

            <div class="stat-card">

                <div class="stat-icon">🩸</div>

                <h4>
                    <?= htmlspecialchars($stats['total_dons'] ?? 0) ?>
                </h4>

                <p>Total des Dons</p>

            </div>

        </div>


        <div class="col-md-3 col-sm-6">

            <div class="stat-card">

                <div class="stat-icon">❤️</div>

                <h4>
                    <?= htmlspecialchars($stats['dons_stock'] ?? 0) ?>
                </h4>

                <p>Dons Disponibles</p>

            </div>

        </div>


        <div class="col-md-3 col-sm-6">

            <div class="stat-card">

                <div class="stat-icon">🏥</div>

                <h4>
                    <?= htmlspecialchars($stats['total_centres'] ?? 0) ?>
                </h4>

                <p>Centres de Collecte</p>

            </div>

        </div>

    </div>



    <div class="dashboard-card">

        <h3 class="section-title">
             État du Stock par Groupe Sanguin
        </h3>

        <div class="table-container">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>
                        <th>Groupe Sanguin</th>
                        <th>Quantité Disponible</th>
                        <th>Niveau du Stock</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($stock_par_groupe)): ?>

                        <?php
                        $max_stock = max(array_column($stock_par_groupe, 'quantite_stock'));
                        ?>

                        <?php foreach ($stock_par_groupe as $stock): ?>

                            <?php
                            $pourcentage = ($stock['quantite_stock'] / $max_stock) * 100;
                            ?>

                            <tr>

                                <td>
                                    <span class="badge-groupe">
                                        <?= htmlspecialchars($stock['groupe_complet']) ?>
                                    </span>
                                </td>

                                <td>
                                    <strong>
                                        <?= htmlspecialchars($stock['quantite_stock']) ?>
                                    </strong>
                                </td>

                                <td>

                                    <div class="progress">

                                        <div class="progress-bar"
                                             style="width: <?= $pourcentage ?>%">
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Aucun don disponible en stock.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>



    <div class="dashboard-card">

        <h3 class="section-title">
             Alertes des Besoins en Sang
        </h3>

        <?php if (!empty($alertes_critiques)): ?>

            <div class="row g-3">

                <?php foreach ($alertes_critiques as $alerte): ?>

                    <?php
                    $alert_class = $alerte['niveau_alerte'] === 'CRITIQUE'
                        ? 'alerte-critique'
                        : 'alerte-urgent';
                    ?>

                    <div class="col-md-4">

                        <div class="alerte-card <?= $alert_class ?>">

                            <h5>

                                <?php if ($alerte['niveau_alerte'] === 'CRITIQUE'): ?>

                                     CRITIQUE

                                <?php else: ?>

                                     URGENT

                                <?php endif; ?>

                            </h5>

                            <p class="mb-0">
                                Besoin de sang du groupe :

                                <strong>
                                    <?= htmlspecialchars($alerte['groupe_sanguin']) ?>
                                </strong>
                            </p>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="alerte-success">

                 Aucune alerte critique ou urgente.

            </div>

        <?php endif; ?>

    </div>


</div>

</body>

</html>