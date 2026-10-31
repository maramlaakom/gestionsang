<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Transfusions</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
   
    .glass {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(6px);
    }

  body {
        background: linear-gradient(135deg,rgba(255, 142, 164, 0.75) 0%, rgba(221, 89, 126, 0.85)100%);
        min-height: 100vh;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }
</style>

</head>

<body class="d-flex justify-content-center align-items-center p-4">

<div class="container">

    <div class="glass shadow-lg rounded-4 p-4 col-12 col-md-6 col-lg-4 mx-auto border border-white border-opacity-50">

        <h3 class="text-center fw-bold mb-4 text-danger">Enregistrer une Transfusion</h3>

        <?php if (!empty($message)) echo $message; ?>

        <form method="POST">

          
            <div class="mb-3">
                <label class="form-label fw-semibold">Don :</label>
                <select name="id_don" class="form-select" required>
                    <option value="">-- Choisir un don --</option>
                    <?php foreach($dons as $d): ?>
                        <option value="<?= htmlspecialchars($d['id_don']) ?>">
                            Don n°<?= htmlspecialchars($d['id_don']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

         
            <div class="mb-4">
                <label class="form-label fw-semibold">Hôpital :</label>
                <input type="text" name="hospital" class="form-control" required>
            </div>

           
            <button type="submit" name="submit" 
                class="btn btn-danger w-100 py-2 fw-semibold">
                Transfuser
            </button>

        </form>
    </div>

</div>

</body>
</html>

