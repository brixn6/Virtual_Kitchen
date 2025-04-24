<?php
session_start();
include 'db.php';
include 'header.php';

$user_id = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>

<form method="GET" action="recipes.php" style="margin: 20px;">
    <input type="text" name="search" placeholder="Search recipes by name or type..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="padding: 10px; width: 275px;">
    <input type="submit" value="Search" style="padding: 10px;">
</form>

<?php if ($user_id): ?>
  <a href="add_recipe.php">
    <button class="styled-button">Add New Recipe</button>
  </a>
<?php endif; ?>

<?php
$search_term = isset($_GET['search']) ? mysqli_real_escape_string($connect, $_GET['search']) : '';


$query = "SELECT * FROM recipes WHERE name LIKE '%$search_term%' OR type LIKE '%$search_term%' ORDER BY uid DESC";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

while ($recipe = mysqli_fetch_assoc($result)) {
    
    echo "<div style='border:1px solid #ccc; padding:15px; margin:10px 0; background-color: #f9f9f9; border-radius: 8px;'>";

    
    echo "<h3 style='margin: 0; font-size: 20px;'>";
    echo "<a href='view_recipe.php?id=" . $recipe['rid'] . "' style='text-decoration: none; color: rgb(148, 187, 116); font-size: 30px;'>" . htmlspecialchars($recipe['name']) . "</a>";
    echo "</h3>";

    
    if (!empty($recipe['image'])) {
        echo "<img src='uploads/" . htmlspecialchars($recipe['image']) . "' alt='Recipe Image' style='max-width:20%; height:auto; display:block; margin-bottom:10px; margin-top: 15px;'>";
    }

    
    echo "<p style='font-weight: bold; color: #4CAF50;'>" . htmlspecialchars($recipe['type']) . "</p>";

    
    echo "<p style='font-size: 14px;'>" . nl2br(htmlspecialchars($recipe['description'])) . "</p>";

    
    if (isset($_SESSION['user_id']) && $recipe['uid'] == $_SESSION['user_id']) {
        echo "<a href='edit_recipe.php?id=" . $recipe['rid'] . "'>
                  <button class='styled-button'>Edit Recipe</button>
              </a>";
        echo "<form method='post' action='delete_recipe.php' style='display:inline; margin-left:10px;'>
                  <input type='hidden' name='recipe_id' value='" . $recipe['rid'] . "' />
                  <button type='submit' class='styled-button'>Delete Recipe</button>
              </form>";
    }

    
    echo "</div>";
}
?>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Recipes | Virtual Kitchen</title>
<link rel="icon" href="images/favicon.ico?v=2" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" />
