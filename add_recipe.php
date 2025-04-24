<?php
session_start();
include 'db.php';
include 'header.php';


if (!isset($_SESSION['username'])) {
    
    header('Location: index.php');
    exit();
}


$uid = $_SESSION['user_id'];  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $type = mysqli_real_escape_string($connect, $_POST['type']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $time = mysqli_real_escape_string($connect, $_POST['time']);
    $ingredients = mysqli_real_escape_string($connect, $_POST['ingredients']);
    $instructions = mysqli_real_escape_string($connect, $_POST['instructions']);

    
    $image_name = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image_name);
    }

    
    $query = "INSERT INTO recipes (uid, name, type, description, Cookingtime, ingredients, instructions, image)
              VALUES ('$uid', '$title', '$type', '$description', '$time', '$ingredients', '$instructions', '$image_name')";

    if (mysqli_query($connect, $query)) {
        
        header("Location: recipes.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connect);
    }
}
?>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>New Recipe | Virtual Kitchen</title>
<link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<h2 style="font-size: 40px;">Add New Recipe</h2>

<div class="form-container">
    <form method="post" action="add_recipe.php" enctype="multipart/form-data">
        <label>Recipe Name:</label><br>
        <input type="text" name="title" required><br><br>

        <label>Type of Dish:</label><br>
        <select name="type" required>
            <option value="">-- Select Cuisine --</option>
            <option value="French">French</option>
            <option value="Italian">Italian</option>
            <option value="Chinese">Chinese</option>
            <option value="Indian">Indian</option>
            <option value="Mexican">Mexican</option>
            <option value="Others">Others</option>
        </select><br><br>

        <label>Description:</label><br>
        <textarea name="description" rows="4" required></textarea><br><br>

        <label>Cooking Time (e.g. 45 mins):</label><br>
        <input type="number" name="time" required><br><br>

        <label>Ingredients:</label><br>
        <textarea name="ingredients" rows="4" required></textarea><br><br>

        <label>Instructions:</label><br>
        <textarea name="instructions" rows="6" required></textarea><br><br>

        <label>Upload Image (optional):</label><br>
        <input type="file" name="image" accept="image/*"><br><br>

        <input type="submit" value="Submit Recipe">
        
    </form>

    <a href="recipes.php"><button type="button">Back to Recipes</button></a>
</div>



