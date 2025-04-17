<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'inscriptions';
$username = 'root'; // Par défaut, XAMPP utilise 'root' sans mot de passe
$password = ''; // Par défaut, il n'y a pas de mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les données du formulaire
$nom = $_POST['ident'][0]; // Nom
$prenom = $_POST['ident'][1]; // Prénom
$age = $_POST['ident'][2]; // Âge

// Langues sélectionnées
$langues = isset($_POST['lang']) ? implode(", ", $_POST['lang']) : '';

// Compétences sélectionnées
$competences = isset($_POST['competent']) ? implode(", ", $_POST['competent']) : '';

// Insertion des données dans la base
$query = "INSERT INTO utilisateurs (nom, prenom, age, langues, competences) 
          VALUES (:nom, :prenom, :age, :langues, :competences)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':age', $age);
$stmt->bindParam(':langues', $langues);
$stmt->bindParam(':competences', $competences);

$stmt->execute();

echo "Inscription réussie !";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dernière Soumission</title>
    <style>
        body {
            background: url('http://localhost/formulaire/pictures/matricee.gif') no-repeat center center fixed;
    background-size: cover;
            color: #00FF00; /* Texte vert fluo */
            font-family: "Courier New", monospace;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 2px solid #00FF00;
        }
        th, td {
            border: 1px solid #00FF00;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #003300;
        }
        td {
            background-color: #001A00;
        }
        a {
            color: #00FF00;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>




<a href="expform2.html">⬅ Retour au formulaire</a>

</body>
</html>
