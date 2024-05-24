<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bare - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page content-->
    <div class="container">
        <div class="text-center mt-5">
            <h1>A Bootstrap 5 Starter Template</h1>
            <p class="lead">A complete project boilerplate built with Bootstrap</p>
            <p>Bootstrap v5.2.3</p>
        </div>

        <div class="mt-5">
            <?php
            // Conectare la baza de date
            $conn = new mysqli('localhost', 'root', '', 'univ');

            // Verificare conexiune
            if ($conn->connect_error) {
                die("Conexiunea a eșuat: " . $conn->connect_error);
            }

            // Interogare baza de date pentru a obține informațiile despre cărți
            $sql = "SELECT Name, Author, Price, Type, Image FROM books";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Afișare cărți
                while($row = $result->fetch_assoc()) {
                    echo '<div class="row mb-4">';
                    echo '<div class="col-md-4">';
                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row["Image"]).'" class="img-fluid" alt="'.$row["Name"].'">';
                    echo '</div>';
                    echo '<div class="col-md-8">';
                    echo '<h5>'.$row["Name"].'</h5>';
                    echo '<p><strong>Autor:</strong> '.$row["Author"].'</p>';
                    echo '<p><strong>Preț:</strong> '.$row["Price"].' RON</p>';
                    echo '<p><strong>Gen:</strong> '.$row["Type"].'</p>';
                     // Adăugarea butoanelor pentru acțiuni (Get, Insert, Delete)
                     echo '<form action="procedures/get_books.php" method="post" style="display: inline;">';
                     echo '<input type="hidden" name="Name" value="'.$row["Name"].'">';
                     echo '<button type="submit">Get</button>';
                     echo '</form>';
                     echo '<form action="procedures/insert_books.php" method="post" style="display: inline;">';
                     echo '<input type="hidden" name="Name" value="'.$row["Name"].'">';
                     echo '<button type="submit">Insert</button>';
                     echo '</form>';
                     echo '<form action="procedures/delete_books.php" method="post" style="display: inline;">';
                    echo '<input type="hidden" name="name" value="'.$row["Name"].'">';
                    echo '<button type="submit">Delete</button>';
                    echo '</form>';

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nu există cărți disponibile.";
            }

            $conn->close();
            ?>
        </div>
    </div>

    

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
