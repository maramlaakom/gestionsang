<?php
session_start();
require_once '../includes/connexion.php'; // connexion PDO

$error = "";


if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        
        $sql = "SELECT id_utilisateur, role, mot_de_passe_hash 
                FROM utilisateurs 
                WHERE nom = :username";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            
            if (password_verify($password, $user['mot_de_passe_hash'])) {

                $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                $_SESSION['role'] = ucfirst(strtolower($user['role']));

                switch (strtolower($user['role'])) {
                    case 'admin':
                        header("Location: ../ADMIN/admin_dashboard.php");
                        exit();
                    case 'medecin':
                        header("Location: ../Medcine/medecin_dashboard.php");
                        exit();
                    case 'secretaire':
                        header("Location: ../SECRETAIRE/secretaire_dashboard (2).php");
                        exit();
                }

            } else {
                $error = "Mot de passe incorrect.";
            }

        } else {
            $error = "Utilisateur non trouvé.";
        }

    } catch (PDOException $e) {
        $error = "Erreur SQL : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f0b1d;
            --bg-accent: #541437;
            --bg-highlight: #b11b45;
        }
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background-image:
                linear-gradient(135deg, rgba(255, 74, 110, 0.75), rgba(114, 0, 33, 0.85)),
                url('../security/don sang.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at top left, rgba(255,255,255,0.25), transparent 55%);
            pointer-events: none;
        }
        .pulse-orb {
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            filter: blur(0.5px);
            animation: pulse 6s ease-in-out infinite;
        }
        .pulse-orb.orb-top {
            top: 8%;
            left: 12%;
            animation-delay: -2s;
        }
        .pulse-orb.orb-bottom {
            bottom: 10%;
            right: 15%;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(0.85); opacity: 0.3; }
            50% { transform: scale(1.1); opacity: 0.6; }
        }
        .login-card {
            width: min(420px, 94%);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 26px;
            padding: 2.8rem 2.4rem;
            box-shadow: 0 35px 80px rgba(6, 5, 20, 0.55);
            border: 1px solid rgba(177, 27, 69, 0.25);
            position: relative;
            overflow: hidden;
        }
        .login-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, 0.45), rgba(255, 255, 255, 0)),
                radial-gradient(circle at 20% 0%, rgba(177, 27, 69, 0.25), transparent 55%);
            pointer-events: none;
        }
        .login-card::after {
            content: "";
            position: absolute;
            inset: 15px;
            border-radius: 22px;
            border: 1px dashed rgba(177, 27, 69, 0.2);
            pointer-events: none;
        }
        .brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 1.1rem;
            border-radius: 999px;
            background: rgba(241, 67, 111, 0.1);
            color: #b11b45;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
        .login-header {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            background: linear-gradient(120deg, #c41e3a, #7a0e2e);
            padding: 0.9rem 1.1rem;
            border-radius: 18px;
            color: #fff;
            box-shadow: 0 15px 30px rgba(122, 14, 46, 0.35);
        }
        .login-header i {
            font-size: 1.6rem;
        }
        .login-header span {
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        .login-card h2 {
            color: #731332;
            font-weight: 700;
            margin-top: 1rem;
        }
        .login-card p {
            color: #6c6a7a;
            font-size: 0.95rem;
        }
        .form-control {
            border-radius: 16px;
            padding: 0.85rem 1rem;
            border: 1px solid #e0dfe7;
            background: #f9f7fb;
        }
        .form-control:focus {
            border-color: var(--bg-highlight);
            box-shadow: 0 0 0 0.15rem rgba(177, 27, 69, 0.15);
        }
        .btn-gradient {
            border-radius: 16px;
            border: none;
            padding: 0.9rem;
            font-weight: 600;
            background: linear-gradient(120deg, #ff4d6d, #b11b45 55%, #7a0e2e);
            color: #fff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(177, 27, 69, 0.35);
        }
            .back-button {
    text-align: center;
    margin-top: 20px;
}

    .back-button a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #f0a0a0; 
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: 0.3s;
    }

    .back-button a:hover {
        background-color: #7e3746; 
    }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <span>Connexion</span>
        </div>
        <h2>Se connecter</h2>
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php } ?>
        <form method="POST">
            <div class="mb-3">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-gradient w-100">Se connecter</button>
             <div class="back-button">
    <a href="acceuil.php">← Retour à l'accueil</a>
</div>
        </form>
    </div>

    <div class="pulse-orb orb-top"></div>
    <div class="pulse-orb orb-bottom"></div>
   
</body>
</html>
