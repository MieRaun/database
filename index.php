

<?php
require_once("database.php");
if(isset($_POST["login"])){
	$brugernavn = $_POST["brugernavn"];
	$password = $_POST["password"];
	
	$login = mysqli_query($con, "SELECT * FROM bruger WHERE username = '{$brugernavn}' AND password = '{$password}'");
    $hentInfo = mysqli_fetch_assoc($login);
	if(mysqli_num_rows($login) >= 1){
        $_SESSION["userid"] = $hentInfo["id"];
		$_SESSION["tjeklogin"] = 1;
?>
<meta http-equiv="refresh" content="0; url=postit.php" />
<?php
	} else {
		echo "Forkert brugernavn eller kodeord";
	}
}
echo $_SESSION["tjeklogin"];
?>
<!doctype html>
<html lang="da">
	<head>
		<title>Log in SYSTEM</title>
        <link rel="stylesheet" href="css.css">
	</head>
	<body>
        <h1>FAMILIE NOTESBLOK</h1>
         <h2>Log-in eller opret en bruger for at kunne logge på den fælles familie notesblok.<h2>
    <div class="bum">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
			<input type="text" name="brugernavn" placeholder="Brugernavn">
			<input type="password" name="password" placeholder="Kodeord">
			<input type="submit" name="login" value="Log ind">
		</form>
		<a class="knap" href="opret.php">Opret bruger</a>
    </div>
	</body>
</html> 