<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['recipe_id'])) {
        $recipe_id = intval($_POST['recipe_id']);

        $user_id = $_SESSION['user_id'];

        $check = mysqli_query($connect, "SELECT * FROM recipes WHERE rid = $recipe_id AND uid = $user_id");
        if (mysqli_num_rows($check) === 1) {
            $query = "DELETE FROM recipes WHERE rid = $recipe_id";
            if (mysqli_query($connect, $query)) {
                header("Location: recipes.php");
                exit();
            } else {
                echo "Failed to delete recipe.";
            }
        } else {
            echo "You do not have permission to delete this recipe.";
        }
    } else {
        echo "No recipe ID provided.";
    }
} else {
    echo "Invalid request.";
}
?>
