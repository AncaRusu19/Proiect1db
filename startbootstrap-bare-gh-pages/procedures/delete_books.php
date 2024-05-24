<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "univ";

try {
    // Conectare la baza de date folosind PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifică dacă a fost trimis un nume de carte
    if (!isset($_POST['name']) || empty($_POST['name'])) {
        throw new Exception("Numele cărții nu a fost furnizat pentru ștergere.");
    }

    // Preia numele cărții din formular
    $name = $_POST['name'];

    // Pregătește și execută ștergerea cărții
    $stmt = $conn->prepare("DELETE FROM books WHERE Name = :Name");
    $stmt->bindParam(':Name', $name);
    $stmt->execute();

    echo "Cartea a fost ștearsă cu succes.";
} catch(PDOException $e) {
    echo "Eroare la ștergerea cărții: " . $e->getMessage();
} catch(Exception $e) {
    echo $e->getMessage();
}

// Închiderea conexiunii
$conn = null;
?>
