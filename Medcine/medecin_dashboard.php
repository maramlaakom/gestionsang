<?php
require 'auth.php';

if ($_SESSION['role'] !== 'Medecin') {
    echo "Accès refusé !";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Médecin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            display: flex;
            height: 100vh;
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, rgba(233,200,205,0.8) 0%, rgba(235,87,129,0.8) 100%);
        }

        /* Sidebar */
        .lien {
            width: 250px;
            min-width: 250px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            padding: 25px 18px;
            box-shadow: 5px 0 20px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
        }

        .lien h3 {
            text-align: center;
            color: #8c0f32;
            font-weight: 700;
            margin-bottom: 35px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f3b5c4;
        }

        .lien a {
            display: block;
            color: #8c0f32;
            padding: 13px 15px;
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .lien a:hover {
            background: linear-gradient(120deg, #ff4d6d, #b11b45);
            color: white;
            transform: translateX(5px);
        }

        /* Déconnexion */
        .logout {
            margin-top: auto;
            background: linear-gradient(120deg, #ff4d6d, #b11b45);
            color: white !important;
            text-align: center;
        }

        .logout:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        /* Contenu */
        .content-frame {
            flex: 1;
            border: none;
            height: 100%;
            background: transparent;
        }
    </style>
</head>

<body>

    <div class="lien">

        <h3>MENU MÉDECIN</h3>

        <a href="../Tableau/index.php" target="contentFrame">
            Accueil
        </a>

        <a href="valider_tests.php" target="contentFrame">
            Valider Tests
        </a>

        <a href="/security/logout.php" class="logout">
            Déconnexion
        </a>

    </div>

    <iframe class="content-frame"
            name="contentFrame"
            src="../Tableau/index.php">
    </iframe>

</body>
</html>