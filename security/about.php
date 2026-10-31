<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos - Don de Sang</title>
    <style>
        body {
            background: url('imge1.jpg') center/cover no-repeat;
        }

        .about-container {
            max-width: 900px;
            margin: 120px auto 50px;
            padding: 20px;
            line-height: 1.8;
        }

        .about-container h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #e63946;
        }

        .about-container h2 {
            margin-top: 30px;
            color: #c71c30;
        }

        .about-container ul {
            margin-left: 30px;
        }

        .about-img {
            width: 100%;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        .back-button {
    text-align: center;
    margin-top: 20px;
}

    .back-button a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #d32f2f; 
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .back-button a:hover {
        background-color: #b71c1c; 
    }

    </style>
</head>

<body>

<?php include "navbar.php"; ?>  

<div class="about-container">
    <h1>À propos de notre plateforme</h1>

    <p>
        Notre plateforme de gestion du don de sang a été créée dans le cadre d’un projet
        académique à l’ISET Sousse. Elle a pour objectif de faciliter l’organisation du don
        de sang, de gérer les donneurs, les dons et le stock d’une manière moderne et efficace.
    </p>

    <h2>Pourquoi ce projet ?</h2>
    <p>
        Le don de sang est un acte humanitaire essentiel qui peut sauver jusqu’à 3 vies à
        chaque don. Malheureusement, la gestion traditionnelle peut être lente et compliquée.
        C’est pourquoi nous avons décidé de développer une solution numérique simple,
        sécurisée et facile à utiliser.
    </p>

    <h2>Objectifs de la plateforme</h2>
    <ul>
        <li>Digitaliser la gestion des donneurs et des dons</li>
        <li>Faciliter l’accès aux informations</li>
        <li>Optimiser le suivi du stock de sang</li>
        <li>Améliorer la rapidité et la fiabilité des données</li>
    </ul>

    <h2>Réalisé par</h2>
    <p>
        Ce projet a été développé par <strong>Laakom Maram </strong>, étudiante en
        2ème année Développement des Systèmes Informatiques à l’ISET Sousse.
    </p>

</div>
<div class="back-button">
    <a href="acceuil.php">← Retour à l'accueil</a>
</div>

</body>
</html>
