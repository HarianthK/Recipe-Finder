<?php
require_once 'db_connection.php';
$searchForTitle = $_GET['recipename'];
$pizza = $_GET['pizza'];
print_r($_GET);
echo"hi how are you doing";
if($searchForTitle == ""){
    $searchForTitle = "N/A";
}
if($pizza == 'on'){
    $pizza = 'sauce';
}
echo"<br>post the for loop<br>";
echo"<br>$pizza<br>printingtheaboveitem<br>";

print_r($_GET);
echo"<br>$searchForTitle<br>";
echo"<br>$searchForIngredients<br>";
$sql_statement = "SELECT * FROM `recipies_table` WHERE `recipe_title` LIKE '%$searchForTitle%' 
OR `recipe_ingredients` LIKE '%$pizza%'";


if($connection){
    $result = mysqli_query($connection, $sql_statement);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            echo "recipe id " . $row['id'] . "<br>";
            echo "recipe title " . $row['recipe_title'] . "<br>";
            echo "recipe ingredients " . $row['recipe_ingredients'] . "<br>";
            echo "recipe instructions " . $row['recipe_instructions'] . "<br>";
        }
    }
    else {
        echo "Error with the SQL" . mysqli_error($connection);
    }
}
else{
    echo "Error connecting " . mysqli_connect_error();
}
?>