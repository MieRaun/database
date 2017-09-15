<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Post it</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- nu virker det på en smartphone -->
<link rel="stylesheet" href="css.css">
</head>

<?php
require_once("database.php");
if(isset($_POST["opret"])){
	$brugernavn = $_POST["brugernavn"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	
	mysqli_query($con, "INSERT INTO bruger (username, password, email) VALUES ('{$brugernavn}','{$password}','{$email}')");
	echo "Bruger oprettet";
}
?>
    
<!doctype html>
<html lang="da">
	<head>
		<title>Log på systemet her.</title>
	</head>
	<body>
        <h1>FAMILIE NOTESBLOK</h1>
        <h2>For at kunne komme ind på det fælles notesystem, skal du oprette en bruger, hvis du ikke allerede har et login.</h2>
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
			<input type="text" name="brugernavn" placeholder="Brugernavn">
			<input type="password" name="password" placeholder="Kodeord">
			<input type="email" name="email" placeholder="Email">
			<input type="submit" name="opret" value="Opret">
             <h3>Klik <a href="index.php"> HER </a>for at komme tilbage til forsiden.</h3>
		</form>
	</body>
</html> 