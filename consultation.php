<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liste des participants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .centered-text {
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des participants enregistrés</h2>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connexion à la base de données MySQL
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "participants_db";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("La connexion à la base de données a échoué : " . $conn->connect_error);
                }

                // Récupération des données des participants depuis la base de données
                $sql = "SELECT * FROM participants";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['telephone'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucun participant enregistré.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <p class="centered-text">
            <a href="enregistrement.php" class="btn">Enregistrer un nouveau participant</a>
        </p>
    </div>
</body>
</html>