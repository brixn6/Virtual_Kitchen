<?php session_start();
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $recipe['name']; ?> | Virtual Kitchen</title>
    <link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
    <script defer src="js/basic.js"></script>
</head>
<body>

<div class="container">
    <h1><?php echo $recipe['name']; ?></h1>
    <p><strong>Uploaded by:</strong> <?php echo $recipe['username']; ?></p>
    <p><strong>Type:</strong> <?php echo $recipe['type']; ?></p>
    <p><strong>Cooking Time:</strong> <?php echo $recipe['Cookingtime']; ?> mins</p>
    <p><strong>Description:</strong><br><?php echo nl2br($recipe['description']); ?></p>
    <p><strong>Ingredients:</strong><br><?php echo nl2br($recipe['ingredients']); ?></p>
    <p><strong>Instructions:</strong><br><?php echo nl2br($recipe['instructions']); ?></p>

    <?php
    if (!empty($recipe['image'])) {
        echo "<img src='uploads/" . htmlspecialchars($recipe['image']) . "' alt='Recipe Image'>";
    }
    ?>

    <br><br>
    <a href="recipes.php">
        <button class="styled-button">Back to Recipes</button>
    </a>
</div>

</body>
</html>