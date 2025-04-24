<?php
session_start();
include 'db.php';
include 'header.php';

if (!isset($_GET['id'])) {
    die("Recipe not found.");
}

$rid = intval($_GET['id']);

$sql = "
  SELECT recipes.*, users.username, users.email 
  FROM recipes 
  JOIN users ON recipes.uid = users.uid 
  WHERE recipes.rid = $rid
";
$result = $connect->query($sql);

if ($result->num_rows === 0) {
    die("No recipe found with that ID.");
}

$recipe = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($connect, $_POST['title']);
    $type = mysqli_real_escape_string($connect, $_POST['type']);
    $description = mysqli_real_escape_string($connect, $_POST['description']);
    $time = intval($_POST['time']);
    $ingredients = mysqli_real_escape_string($connect, $_POST['ingredients']);
    $instructions = mysqli_real_escape_string($connect, $_POST['instructions']);

    $imageName = $recipe['image'];
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;

   
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "Error uploading image.";
        }
    }

    $update = "
        UPDATE recipes SET
            name = '$title',
            type = '$type',
            description = '$description',
            Cookingtime = $time,
            ingredients = '$ingredients',
            instructions = '$instructions',
            image = '$imageName'
        WHERE rid = $rid
    ";

    if ($connect->query($update)) {
        header("Location: recipes.php?success=updated");
        exit;
    } else {
        echo "Error updating recipe: " . $connect->error;
    }
}


$sql = "
  SELECT recipes.*, users.username, users.email 
  FROM recipes 
  JOIN users ON recipes.uid = users.uid 
  WHERE recipes.rid = $rid
";
$result = $connect->query($sql);

if ($result->num_rows === 0) {
    die("No recipe found with that ID.");
}

$recipe = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Recipe | Virtual Kitchen</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="form-container">
  <h1>Edit Recipe: <?php echo htmlspecialchars($recipe['name']); ?></h1>

  <form method="POST" action="edit_recipe.php?id=<?php echo $recipe['rid']; ?>" enctype="multipart/form-data">
    <label for="title">Recipe Name:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($recipe['name']); ?>" required><br><br>

    <label for="type">Type of Dish:</label><br>
    <select name="type" required>
      <option value="French" <?php echo $recipe['type'] == 'French' ? 'selected' : ''; ?>>French</option>
      <option value="Italian" <?php echo $recipe['type'] == 'Italian' ? 'selected' : ''; ?>>Italian</option>
      <option value="Chinese" <?php echo $recipe['type'] == 'Chinese' ? 'selected' : ''; ?>>Chinese</option>
      <option value="Indian" <?php echo $recipe['type'] == 'Indian' ? 'selected' : ''; ?>>Indian</option>
      <option value="Mexican" <?php echo $recipe['type'] == 'Mexican' ? 'selected' : ''; ?>>Mexican</option>
      <option value="Others" <?php echo $recipe['type'] == 'Others' ? 'selected' : ''; ?>>Others</option>
    </select><br><br>

    <label for="description">Description:</label><br>
    <textarea name="description" rows="4" required><?php echo htmlspecialchars($recipe['description']); ?></textarea><br><br>

    <label for="time">Cooking Time (e.g. 45 mins):</label><br>
    <input type="number" name="time" value="<?php echo htmlspecialchars($recipe['Cookingtime']); ?>" required><br><br>

    <label for="ingredients">Ingredients:</label><br>
    <textarea name="ingredients" rows="4" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea><br><br>

    <label for="instructions">Instructions:</label><br>
    <textarea name="instructions" rows="6" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea><br><br>

    <label for="image">Upload New Image (optional):</label><br>
    <input type="file" name="image" accept="image/*"><br><br>

    <input type="submit" value="Update Recipe" class="styled-button">
  </form>
</div>
  <br><br>
  <a href="recipes.php">
    <button class="styled-button">Back to Recipes</button>
  </a>
 	</body>
 </html>