<?php
    //file deletion code goes here
	require_once('config.php');
	$recipe = null; // Initialize $recipe


    // Get the recipe ID from the form submission
    $recipe_id = $_POST['recipe_id'];

    // Prepare and execute the SQL query to delete the recipe
    $sql = "DELETE FROM addrecipe WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipe_id);

    if ($stmt->execute()) {
        // Recipe deleted successfully
      //  echo "Recipe deleted successfully";
        header("Location:recipes.php");
    } else {
        // Error deleting recipe
        echo "Error deleting recipe: " . $stmt->error;
    }
?>
