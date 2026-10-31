<!-- contact.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('imge2.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: flex-end; 
        align-items: flex-start;  
        height: 100vh; 
    }

    .contact-container {
        width: 400px;
        margin: 70px; 
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
         url('imge1.jpg') center/cover no-repeat;
    }

        .contact-container {
            max-width: 500px;
            height: 500px;
            margin: 200px ;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #d32f2f;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info span {
            font-weight: bold;
        }
        .email-link {
            color: #d32f2f;
            text-decoration: none;
        }
        .email-link:hover {
            text-decoration: underline;
        }
        .contact-image {
    text-align: center; 
    margin-top: 20px;  
        }

        .contact-image img {
            max-width: 100%;    
            height: auto;     
            border-radius: 10px; 
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
    <div class="contact-container">
    <h2>Contactez-nous</h2>
    <p>Si vous voulez poser une question ou vous renseigner, vous pouvez nous contacter par :</p>
    <div class="contact-info">
        <p><span>Téléphone:</span> +216 12 345 678</p>
        <p><span>Email:</span> <a href="mailto:contact@dondesang.com" class="email-link">contact@dondesang.com</a></p>
        <p><strong>Horaires :</strong> Lundi à Vendredi 9h - 17h</p>
        <p>Chaque don peut sauver jusqu'à 3 vies. Merci pour votre générosité!</p>
        <img src="imge3.jpg" width="100" style="display:block; margin: 10px auto;">
        <div class="back-button">
            <a href="acceuil.php">← Retour à l'accueil</a>
        </div>
    </div>

</body>
</html>

