<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "univ";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Apelarea procedurii stocate INSERT
    $sql = "CALL InsertBook(:bookName, :authorName, :bookPrice, :bookType, :bookImage)";
    $stmt = $conn->prepare($sql);

    // Parametrii procedurii
    $stmt->bindParam(':bookName', $bookName);
    $stmt->bindParam(':authorName', $authorName);
    $stmt->bindParam(':bookPrice', $bookPrice);
    $stmt->bindParam(':bookType', $bookType);
    $stmt->bindParam(':bookImage', $bookImage, PDO::PARAM_LOB);

    // Setarea valorilor parametrilor
    $bookName = "Matilda";
    $authorName = "Roald Dahl";
    $bookPrice = 35;
    $bookType = "Copii";
    $bookImage = file_get_contents("../img/matilda.jpg"); // Încărcă imaginea dintr-un fișier

    // Executarea procedurii
    $stmt->execute();
    echo "Cartea a fost inserată cu succes";
} catch(PDOException $e) {
    echo "Eroare la inserarea cărții: " . $e->getMessage();
}

// Închiderea conexiunii
$conn = null;
?>
