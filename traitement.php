<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'inscrptions';
$username = 'root'; // Par défaut, XAMPP utilise 'root' sans mot de passe
$password = ''; // Par défaut, il n'y a pas de mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$date_naissance = $_POST['date_naissance'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$profession = $_POST['profession'];
$autre_profession = $_POST['autre_profession'] ?? '';
$centres = implode(', ', $_POST['centres'] ?? []); // Combinaison des centres d'intérêt sélectionnés
$niveau = isset($_POST['niveau']) ? $_POST['niveau'] : 'Non spécifié';
$motivations = $_POST['motivations'];

// Insertion des données dans la base de données
$query = "INSERT INTO adhesions (nom, prenom, date_naissance, telephone, email, profession, autre_profession, centres, niveau, motivations) 
          VALUES (:nom, :prenom, :date_naissance, :telephone, :email, :profession, :autres_profession, :centres, :niveau, :motivations)";

$stmt = $pdo->prepare($query);

$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':date_naissance', $date_naissance);
$stmt->bindParam(':telephone', $telephone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':profession', $profession);
$stmt->bindParam(':autres_profession', $autre_profession);
$stmt->bindParam(':centres', $centres);
$stmt->bindParam(':niveau', $niveau);
$stmt->bindParam(':motivations', $motivations);

$stmt->execute();

echo "Adhésion réussie !";
$sql = "SELECT * FROM adhesions ORDER BY id DESC LIMIT 1";
$stmt = $pdo->query($sql);

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

<h2>Dernière Soumission :</h2>

<?php
// Vérification des résultats et affichage
if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<table>";
    echo "<tr><th>ID</th><td>" . htmlspecialchars($row["id"]) . "</td></tr>";
    echo "<tr><th>Nom</th><td>" . htmlspecialchars($row["nom"]) . "</td></tr>";
    echo "<tr><th>Prénom</th><td>" . htmlspecialchars($row["prenom"]) . "</td></tr>";
    echo "<tr><th>Email</th><td>" . htmlspecialchars($row["email"]) . "</td></tr>";
    echo "<tr><th>Profession</th><td>" . htmlspecialchars($row["profession"]) . "</td></tr>";
    echo "<tr><th>Centres d'intérêt</th><td>" . htmlspecialchars($row["centres"]) . "</td></tr>";
    echo "</table>";
} else {
    echo "<p>Aucune soumission trouvée.</p>";
}
?>

<br>
<a href="formechecs.html">⬅ Retour au formulaire</a>
<?php
// Inclusion de la connexion à la base de données
require_once 'database.php';

// Votre code ici (par exemple, récupérer ou insérer des données)
$query = "SELECT * FROM utilisateurs";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['nom'];
}
?>
</body>
</html>