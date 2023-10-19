
<?php
// Récupération des données du formulaire
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";

// Vérification si toutes les données nécessaires sont présentes
if ($nom !== "" && $prenom !== "" && $telephone !== "" && $email !== "") {
    // Connexion à la base de données MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "participants_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    // Insertion des données dans la table "participants"
    $sql = "INSERT INTO participants (nom, prenom, telephone, email) VALUES ('$nom', '$prenom', '$telephone', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Enregistrement réussi";
    } else {
        echo "Erreur lors de l'enregistrement : " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Enregistrement des participants</title>
    <style>
       <head>
    <meta charset="UTF-8">
    <title>Enregistrement des participants</title>
    <style>
        .error {
            color: red;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
    </style>
</head>
<body>
    <h2>Enregistrement des participants</h2>

    <form id="participantForm" action="enregistrement.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="tel" id="telephone" name="telephone" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>

        <input type="submit" value="Enregistrer">
    </form>

    <script>
        document.getElementById("participantForm").addEventListener("submit", function(event) {
            var errors = [];

            // Validation des données saisies par l'utilisateur
            var nom = document.getElementById("nom").value.trim();
            if (nom.length === 0) {
                errors.push("Le nom doit être saisi.");
            }

            var prenom = document.getElementById("prenom").value.trim();
            if (prenom.length === 0) {
                errors.push("Le prénom doit être saisi.");
            }

            var telephone = document.getElementById("telephone").value.trim();
            if (telephone.length === 0) {
                errors.push("Le numéro de téléphone doit être saisi.");
            }

            var email = document.getElementById("email").value.trim();
            if (email.length === 0) {
                errors.push("L'adresse email doit être saisie.");
            }

            if (errors.length > 0) {
                event.preventDefault(); // Empêche la soumission du formulaire
                var errorMessage = "Erreurs rencontrées :\n";
                errorMessage += errors.join("\n");
                alert(errorMessage);
            }
        });
    </script>
    <a href="consultation.php">Consulter la liste des participants</a>
</body>
</html>
