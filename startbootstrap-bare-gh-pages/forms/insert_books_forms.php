<!-- insert_books_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Book Form</title>
</head>
<body>
    <h2>Insert New Book</h2>
    <form action="../procedures/insert_books.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" required><br><br>
        
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br><br>
        
        <label for="type">Type:</label><br>
        <input type="text" id="type" name="type" required><br><br>
        
        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" required accept="image/*"><br><br>
        
        <input type="submit" value="Insert Book">
    </form>
</body>
</html>
