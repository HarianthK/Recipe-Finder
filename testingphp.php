<?php
require_once 'db_connection.php';
$res = implode($_GET);
if($searchForTitle == ""){
    $searchForTitle = "N/A";
}
$arr = array("SELECT * FROM `finaldb1_txt` WHERE `recipies_title` LIKE '%$searchForTitle%'");
foreach($_GET as $x => $x_value) {
    array_push($arr,"OR `recipe_ingredients` LIKE '%$x%'");
  }
$sql_statement = join(" ",$arr);
if($connection){
    $result = mysqli_query($connection, $sql_statement);
    echo ' 
                   <style>
                   body{
                       padding:20px;
                   }
                   .box1{
                       padding: 20px;
                       background-color: lightskyblue;
                       margin: 10px;
                   }
                   .container{
                       display: flex;
                       flex-direction: row;
                       flex-wrap : wrap;
                       padding: 20px;
                   }
                   .spacer{
                       margin-left: auto;
                   }
                   .recipeCard
                   {
                       display : flex;
                       align-items:center;
                       width: 40%;
                       background-color: #777;
                       flex-direction: row;
                       margin: 20px;
                       padding: 20px;
                       box-shadow: 10px 5px 30px 5px #999;
                       border-radius: 7px;
                       color: #000;
                   }
                   .recipeCard > img{
                       width: 30%;
                       height: 150px;
                   }
                   .recipeContent{
                       display: flex;
                       flex-direction: column;
                       width: 70%;
                   }
                   .recipeContent h2{
                       text-align: center;
                       text-decoration: underline;
                   }
                   .recipeContent > a{
                       color: #fff;
                       text-align: center;
                   }
                   .recipeContent h3{
                       text-align: center;
                       margin-bottom: 0px;
                   }
                   .recipeContent h4{
                       text-align: center;
                       margin-top: 0px;
                       padding-top: 0px;
                   }
                   @media only screen and (max-width: 1000px){
                       .container{
                           flex-direction: column;
                       }
                       .spacer{
                           margin: 0px;
                       }
                       .recipeCard{
                           width: 90%;
                       }
                   }
               </style>
        <body>
            <div class="container"> 
           ';
    if($result){
        $counter=0;
        while($row = mysqli_fetch_assoc($result)){
            $ring = $row['recipe_ingredients'];
            $ring11 = explode("\n", $row['recipe_ingredients']);
            $total = count($ring11);
            $count = 0;
            $ingcount = 0;
            $ingreq = (int)$ring[0]."<br>";
            foreach($_GET as $i){
                if(strripos($ring,$i) > 0){
                    $count = $count+1;
                    $ingcount = $ingcount + (int)$ring[stripos($ring,$i)+strlen($i)+1];
                        }
                    }
                $perc = ($count/$total)*100;
            if((int)$ingcount == (int)$ingreq){
                $counter=$counter+1;
                if($counter%2 == 0){
                        echo'
                            <div class="spacer"></div>
                        ';
                }
                echo ' 
                        <div class="recipeCard">
                        <img src="images2/'.$row['recipies_title'].'.jpg" alternate="recipeimage">
                            <div class="recipeContent">
                                <h2> '.$row['recipies_title'].'</h2>
                                '.'<a href="recipes/'.$row['recipies_title'].'.html" target = "__blank">'.$row['recipies_title'].' Instructions</a>';
                                echo "<h3>Ingredients Found:";
                                echo '</h3>';
                                echo '<h4>';
                                foreach($_GET as $i){
                                    if(strripos($ring,$i) > 0){
                                        echo "<br>$i";
                                            }
                                        }
                                echo"<br>";
                                #echo round($perc,2)."% Percentage Ingredients matched";
                            echo'
                                </h4>
                            </div>
                        </div>';
                }
        }
        echo '</div>
        </body>';
    }
    else {
        echo "Error with the SQL" . mysqli_error($connection);
    }
}
else{
    echo "Error connecting " . mysqli_connect_error();
}
?>