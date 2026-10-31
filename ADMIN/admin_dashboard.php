<?php
require 'auth.php';

if ($_SESSION['role'] !== 'Admin') {
    echo "Accès refusé !";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

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

        <h3>MENU ADMIN</h3>

        <a href="../Tableau/index.php" target="contentFrame">
            Accueil
        </a>

        <a href="donneurs_list.php" target="contentFrame">
            Liste des Donneurs
        </a>

        <a href="donneurs_add(1).php" target="contentFrame">
            Ajouter un Donneur
        </a>

        <a href="Transfusion.php" target="contentFrame">
            Transfusion
        </a>

        <a href="Enregistrement _de _Don.php" target="contentFrame">
            Enregistrer un Don
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