<?php
require_once("database.php");
if(!isset($_SESSION["tjeklogin"])){
	echo "Du er ikke logget ind. Klik <a href=\"index.php\">her</a> for at logge ind";
} else {
?>

<!doctype html>
<html lang="da">
	<head>
		<title>Log ind på systemet</title>
	</head>
	<body>
	    <h1>
		  Her er en hemmelig side, som kun den bruger der er logget ind kan se! - sååå TILLYKKE dette er din hemmelige side! :D 
        </h1>
		<a href="logud.php">Log ud</a>
	</body>
</html>

<?php
	   }
?> 