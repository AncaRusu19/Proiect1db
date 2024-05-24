<?php
// Conectare la baza de date
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "univ";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Apelarea procedurii stocate GET
    $sql = "CALL GetBooks()";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Afișarea rezultatelor
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Nume: " . $row['Name'] . "<br>";
        echo "Autor: " . $row['Author'] . "<br>";
        echo "Preț: " . $row['Price'] . "<br>";
        echo "Gen: " . $row['Type'] . "<br>";
        // Poza poate fi afișată aici, folosind un tag <img> și atributul src
        echo "<img src='data:image/jpeg;base64," . base64_encode($row['Image']) . "' alt='Imagine carte'><br><br>";
    }
} catch(PDOException $e) {
    echo "Eroare la obținerea cărților: " . $e->getMessage();
}

// Închiderea conexiunii
$conn = null;
?>
