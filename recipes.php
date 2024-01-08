<?php
    session_start();
    require_once 'config.php';


	$_SESSION["user_username"] = " ";
    $_SESSION["user_nameoffood"] = " ";
    $_SESSION["user_typeoffood"] = " ";
    $_SESSION["user_tasteoffood"] = " ";
    $_SESSION["user_ingredients"] = " ";
    $_SESSION["user_prepare"] = " ";

    
    $u_nameoffood = $_SESSION["user_nameoffood"];
    $u_typeoffood = $_SESSION["user_typeoffood"];
    $u_tasteoffood = $_SESSION["user_tasteoffood"];
    $u_ingredients = $_SESSION["user_ingredients"];
    $u_prepare = $_SESSION["user_prepare"];
    $u_uname = $_SESSION["user_name"];
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecipeRealm-Recipes</title>
    
    <link rel="stylesheet" href="CSS/recipesstyle.css">
   <script>
        function showMessage() {
            alert("Deleted Recipe Successfully!");
            window.location.href = 'homepage.php';
        }
    </script>
</head>
<body>
   
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo1.png" alt="Restaurant Logo" class="img-responsive" style="width:50%;">
                </a>
            </div>
			
            
			<form action = "recipes.php" method = "post">
            <div class="search">
				<input type = "text" name = "searchText" placeholder="Search...">
				<button type = "submit" name = "search" value = "Search"><img src="images/search.png"width="30px" height="30px"></button>
                </div>
			</form>


            <div class="menu text-right">
                <ul>
                    
                    <li>
                        <a href="homepage.php">Home</a>
                    </li>
                    <li>
                        <a href="addrecipe.php">Add Recipe</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>
                    
                    <li>
                        <a href="logout.php" style="color:rgb(196,37,47)">Log Out</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
	
	<center>
		<div class = "recipesSearch">
			<?php
	if(isset($_POST["search"])) {
		
		$searchText = $_POST["searchText"];
		$query = "select * from addrecipe where nameoffood like '$searchText%';";
		$result = mysqli_query($conn, $query);
		
		if(!empty($searchText)) {
		if ($result) {
    // Loop through the rows and generate recipe cards
			while ($row = mysqli_fetch_assoc($result)) {
				$u_nameoffood = $row['nameoffood'];
				$u_typeoffood = $row['typeoffood'];
				$u_tasteoffood = $row['tasteoffood'];
				$u_ingredients = $row['ingredientsfood'];
				$u_prepare = $row['preparefood'];
				
				
				
				// Output the recipe card HTML for each row
				echo "<div class='recipe-card'>";
				echo '<h3>' . $u_nameoffood . '</h3>';
				echo '<p><b>Type Of Food :</b>' . $u_typeoffood . '</p>';
				echo '<p><b>Taste Of Food :</b>' . $u_tasteoffood . '</p>';
				echo '<p><b>Ingredients Of Food :</b>' . $u_ingredients . '</p>';
				echo '<p><b>How to prepare :</b>' . $u_prepare . '</p>';
				
			   
				
				echo '<form method="post" action="delete_Recipe.php">';
				echo '<input type="hidden" name="recipe_id" value="' . $row['id'] . '">';
				echo '<input type="submit" name="delete_recipe" value="Delete Recipe" class="btnDel" onclick="showMessage()">';
				echo '</form>';
			   
				echo '</div>';

		   
			}
		}
		}
		else {
			echo "Please Enter the Recipe Name..!";
		}
	}
	else {
		echo "<div class='recipe-card'>";
		echo "Search for Recipes";
		echo "</div>";
	}
?>
			
		</div>
	</center>
    <!-- Recipes Section -->
    <section class="recipes">
        <div class="recipes-content">
            <div class="recipe-grid">
                <div class="recipe-card">
                    <img src="Images/m pizza.jpg" alt=" ">
                    <h3>Margherita Pizza</h3>
                    <p>Indulge in the classic flavors of Italy with this Margherita Pizza. It's a timeless favorite that brings together the freshness of tomatoes, the creaminess of mozzarella, and the aromatic touch of basil. The crust is crispy on the outside yet wonderfully chewy inside, providing the perfect base for the tomato sauce and melted cheese. Topped with fragrant basil leaves and a drizzle of olive oil, each slice embodies the essence of traditional Italian pizza.</p>
                   <!-- <a href="recipe_details.php">View Recipe</a>-->
                </div>

                <div class="recipe-card">
                    <img src="Images/Mojito-recipe.jpg" alt=" ">
                    <h3>Classic Mojito</h3>
                    <p>The Classic Mojito is a quintessential summer cocktail that radiates a refreshing and minty flavor. This iconic drink combines the tanginess of lime with the sweetness of sugar and the herbal freshness of mint. White rum adds a delightful kick, while club soda brings a fizzy lightness to the concoction. Served over ice, it's a rejuvenating beverage that balances citrusy zest with a hint of sweetness, making it a go-to choice for any occasion.</p>
                    <!--<a href="recipe_details.php">View Recipe</a>-->
                </div>

                 <div class="recipe-card">
                    <img src="Images/Dinner-Rolls-2.jpg" alt=" ">
                    <h3>Soft & Fluffy Dinner Rolls</h3>
                    <p>These Soft & Fluffy Dinner Rolls are the epitome of comfort and warmth. Baked to golden perfection, these pillowy rolls offer a soft interior and a slightly crisp crust. Their irresistible aroma fills the kitchen as they emerge from the oven, inviting you to savor their buttery, melt-in-your-mouth goodness. These rolls complement any meal, serving as the perfect accompaniment to soups, salads, or as delectable standalone treats.</p>
                   <!-- <a href="recipe_details.php">View Recipe</a>-->
                </div>

                 <div class="recipe-card">
                    <img src="Images/SPasta.jpg" alt=" ">
                    <h3>Simple Pasta Delight</h3>
                    <p>This Simple Pasta Delight is a quick yet flavorful dish that celebrates the simplicity of Italian cuisine. The al dente pasta, coated in a fragrant olive oil and garlic sauce, is complemented by juicy cherry tomatoes bursting with sweetness. The addition of fresh basil adds an aromatic and herbaceous note that elevates the dish. Topped with optional grated Parmesan cheese, this dish offers a harmonious blend of textures and flavors, making it a comforting and satisfying meal option.</p>
                  <!--  <a href="recipe_details.php">View Recipe</a>-->
                </div>

                <?php



$query = "SELECT * FROM addrecipe"; 
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Loop through the rows and generate recipe cards
    while ($row = mysqli_fetch_assoc($result)) {
        $u_nameoffood = $row['nameoffood'];
        $u_typeoffood = $row['typeoffood'];
        $u_tasteoffood = $row['tasteoffood'];
        $u_ingredients = $row['ingredientsfood'];
        $u_prepare = $row['preparefood'];
        
        
        // Output the recipe card HTML for each row
        echo '<div class="recipe-card">';
        echo '<h3>' . $u_nameoffood . '</h3>';
        echo '<p><b>Type Of Food :</b>' . $u_typeoffood . '</p>';
        echo '<p><b>Taste Of Food :</b>' . $u_tasteoffood . '</p>';
        echo '<p><b>Ingredients Of Food :</b>' . $u_ingredients . '</p>';
        echo '<p><b>How to prepare :</b>' . $u_prepare . '</p>';
        
       
        
        echo '<form method="post" action="delete_Recipe.php">';
        echo '<input type="hidden" name="recipe_id" value="' . $row['id'] . '">';
        echo '<input type="submit" name="delete_recipe" value="Delete Recipe" class="btnDel" onclick="showMessage()">';
        echo '</form>';
       
        echo '</div>';

       
    }

    // Free result set
    mysqli_free_result($result);
} else {
    // Handle the case where the query was not successful
    echo 'Error executing query: ' . mysqli_error($your_db_connection);
}

?>
   
            </div>
        </div>
               
            </div>
        </div>
    </section>

   
</body>
</html>