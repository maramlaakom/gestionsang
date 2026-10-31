<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Don de Sang</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .navbar {
            width: 95%;
            height: 70px;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 40px;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .navbar .logo {
            font-size: 32px;
            font-weight: bold;
            color: black;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 70px;                 
            align-items: center;        
            padding: 0;
            margin: 0;
        }

        .nav-links li {
            display: inline-block;
        }

        .nav-links li a {
            color: white;
            text-decoration: none;
            font-size: 28px;           
            font-weight: 500;
            letter-spacing: 0.5px;     
            transition: 0.3s ease;
            padding: 6px 10px;          
            border-radius: 6px;
        }

        .nav-links li a:hover {
            background-color: rgba(255, 255, 255, 0.15); 
            color: #e63946;
        }


    
        .login-btn {
            padding: 10px 22px;
            font-size: 16px;
            background-color: #e63946;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #c71c30;
        }

  
        .hero {
            background: url('imgg4.jpg') center/cover no-repeat;
            height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: black;
            text-shadow: 2px 2px 8px black;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin: 0;
        }

        .hero p {
            font-size: 1.4rem;
            margin: 20px 0;
        }

        .features {
            display: flex;
            justify-content: space-around;
            padding: 40px;
        }

        .feature-box {
            width: 30%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 10px #bbb;
        }

        .feature-box img {
            width: 100%;
            height: 300px;
            border-radius: 10px;
        }

        .feature-box h3 {
            margin: 15px 0;
        }

        footer {
            background: #222;
            color: white;
            text-align: center;
            padding: 12px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

 
    <nav class="navbar">
        <div class="logo">Don de Sang</div>

        <ul class="nav-links">
            <li><a href="about.php">A propos</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>

        <button class="login-btn" onclick="location.href='login.php'">LOGIN</button>
    </nav>




    <div class="hero">
        <h1>Donner du sang, c'est sauver des vies</h1>
    </div>

  
    <div class="features">
        <div class="feature-box">
            <img src="imgg5.jpg">
            <h3>Pourquoi donner ?</h3>
            <p>Chaque don peut sauver jusqu'à 3 vies. Votre geste compte.</p>
        </div>

        <div class="feature-box">
            <img src="imgg7.jpg">
            <h3>Comment ça marche ?</h3>
            <p>Processus simple, rapide et totalement sécurisé.</p>
        </div>

        <div class="feature-box">
            <img src="imgg6.jpg">
            <h3>Qui peut donner ?</h3>
            <p>Découvrez les critères et profitez d'une bonne action humaine.</p>
        </div>
    </div>

    <footer>
        © 2025 - Centre National de Don de Sang - Projet ISET Sousse
    </footer>

</body>
</html>
