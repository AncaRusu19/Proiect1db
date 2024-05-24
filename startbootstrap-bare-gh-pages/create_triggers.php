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

    // Crearea tabelului pentru log-uri, dacă nu există deja
    $sql_create_table = "
    CREATE TABLE IF NOT EXISTS books_log (
        id INT AUTO_INCREMENT PRIMARY KEY,
        action VARCHAR(10),
        book_name VARCHAR(255),
        action_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";
    $conn->exec($sql_create_table);

    // Ștergerea trigger-elor existente, dacă există
    $conn->exec("DROP TRIGGER IF EXISTS after_book_insert");
    $conn->exec("DROP TRIGGER IF EXISTS after_book_update");
    $conn->exec("DROP TRIGGER IF EXISTS after_book_delete");

    // Crearea trigger-ului pentru inserare
    $sql_create_insert_trigger = "
    CREATE TRIGGER after_book_insert
    AFTER INSERT ON books
    FOR EACH ROW
    BEGIN
        INSERT INTO books_log (action, book_name)
        VALUES ('INSERT', NEW.Name);
    END;
    ";
    $conn->exec($sql_create_insert_trigger);

    // Crearea trigger-ului pentru actualizare
    $sql_create_update_trigger = "
    CREATE TRIGGER after_book_update
    AFTER UPDATE ON books
    FOR EACH ROW
    BEGIN
        INSERT INTO books_log (action, book_name)
        VALUES ('UPDATE', NEW.Name);
    END;
    ";
    $conn->exec($sql_create_update_trigger);

    // Crearea trigger-ului pentru ștergere
    $sql_create_delete_trigger = "
    CREATE TRIGGER after_book_delete
    AFTER DELETE ON books
    FOR EACH ROW
    BEGIN
        INSERT INTO books_log (action, book_name)
        VALUES ('DELETE', OLD.Name);
    END;
    ";
    $conn->exec($sql_create_delete_trigger);

    echo "Trigger-ele au fost create cu succes.";
} catch(PDOException $e) {
    echo "Eroare la crearea trigger-elor: " . $e->getMessage();
}

// Închiderea conexiunii
$conn = null;
?>
