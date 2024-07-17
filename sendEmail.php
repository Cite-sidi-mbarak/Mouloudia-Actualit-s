<?php
// Configuration de la base de données (à adapter selon votre environnement local)
$servername = "localhost";
$username = "root"; // Utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "contact_form_db"; // Nom de la base de données créée

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs soumises dans le formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    // Préparer la requête d'insertion
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    
    // Préparer la déclaration
    $stmt = $conn->prepare($sql);
    
    // Liage des paramètres et exécution de la requête
    $stmt->bind_param("sss", $name, $email, $message);
    
    if ($stmt->execute()) {
        // Redirection avec un message de succès
        header("Location: index.html?status=success&message=Votre%20message%20a%20été%20envoyé%20avec%20succès.");
        exit;
    } else {
        // Redirection avec un message d'erreur
        header("Location: index.html?status=danger&message=Désolé,%20il%20y%20a%20eu%20une%20erreur%20lors%20de%20l'envoi%20du%20message.");
        exit;
    }
}

// Fermer la connexion à la base de données
$stmt->close();
$conn->close();
?>
