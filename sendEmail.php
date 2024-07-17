<?php
// Configuration de la base de données (à adapter selon votre environnement local)
$servername = "localhost";
$username = "root"; // Utilisateur MySQL
$password = ""; // Mot de passe MySQL
$dbname = "contact_form_db"; // Nom de la base de données créée

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Préparer la requête SQL pour insérer les données dans la table
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
        $statusMsg = "Message sent successfully!";
    } else {
        $statusMsg = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion à la base de données
$conn->close();

// Redirection vers la page de contact avec le message de statut
header("Location: contact.html?status=$statusMsg");
exit;
?>
