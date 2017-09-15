<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Post-it</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- nu virker det på en smartphone -->
<link rel="stylesheet" href="css.css">
</head>

<body>
<?php
require_once('databse.php');
	
	$cmd = filter_input(INPUT_POST, 'cmd', FILTER_SANITIZE_STRING);
	$overskrift = $_POST["overskrift"];
	$note = $_POST["note"];
	$billedeurl = $_POST["billedeurl"];
	
	switch($cmd) {
		case 'Tilføj':
			echo 'will add '.$overskrift.' to the db...';
			require_once('database.php');
			$sql = 'INSERT INTO note (overskrift, userid, note, billedeurl) VALUES (?, ?, ?, ?)';
			$stmt = $con->prepare($sql);
			$stmt->bind_param('ssss', $overskrift, $_SESSION["userid"], $note, $billedeurl);
			$stmt->execute();			
			if ($stmt->affected_rows > 0) {
				echo 'Note added to the list :-)';
			}
			else {
				echo 'Could not add note - its propably already there....';
			}
			break;
		case 'Slet':
			echo 'will remove '.$overskrift.' to the db...';
			require_once('database.php');
			$sql = 'DELETE FROM note WHERE overskrift=?';
			$stmt = $con->prepare($sql);
			$stmt->bind_param('s', $overskrift);
			$stmt->execute();			
			if ($stmt->affected_rows > 0) {
				echo 'Note removed from the list :-)';
			}
			else {
				echo 'Could not delete note - its propably not there....';
			}
			break;
		default: 
			?>
			
			<?php
	}
	
	
?>

    <h1>FAMILIE NOTESBLOK</h1>
    
    <div class="bum">
<form action="<?=$_SERVER['PHP_SELF']?>" method="post"><br><br>
     
    <div class="info">
					   <div class="info">
						<p><strong>INFO</strong><br>Hvis en note skal slettes skal overskriften bare intastes i note feltet, og derefter tryk slet.</p>
					</div>
    </div>
			
				<div class="text">
				 
					<input type="text" placeholder="Overskrift" name="overskrift" required><br>
					<input type="text" placeholder="Billede link" name="billedeurl"><br>
					<textarea name="note" placeholder="Note"></textarea><br>
					<input type="submit" name="cmd" value="Tilføj">
					<input type="submit" name="cmd" value="Slet">
                </div>
    
            </form>
    
   
        
      
        <a class="knap" href="logud.php">Log ud</a>
    </div>
					
  
    <div class="noteindhold">
<?php 
	// SELECT statement
    $notesql = 'SELECT note.id,
note.overskrift,
note.userid,
note.dato,
note.note,
note.billedeurl,
bruger.id,
bruger.username

FROM note

JOIN bruger ON note.userid = bruger.id

ORDER BY note.id DESC';
	$stmt = $con->prepare($notesql);
	// udfør SQL forespørgelse (SELECT)!
	$stmt->execute();
	// nu kan jeg binde værdierne fra kolonnerne til mine egne variabler:
	$stmt->bind_result($id, $overskrift, $userid, $dato, $note, $billede, $bid, $bun);
	// for at få fat i ALLE records er jeg nødt til at gå på en løbetur - og bruge en løkke (loop)	
	// Dynamisk genereret HTML layout:
	// start på min tabel
	  // så længe du kan hente noget fra databasen 😉
	  while($stmt->fetch())  {
		  // overskriver værdien af $op med den tilsvarende aritmetiske tegn til output i tabellen:
          
		
		echo '<div class="note">';
		echo '<h3>'. $overskrift. '</h3>';
		echo '<h3>'. $bun . '</h3>';
		echo '<h4>'. $dato. '</h4>';
		echo '<p>'. $note. '</p>';
		
          if($billede != ""){
            echo '<p><img src="'. $billede. '" alt="Billede"></p>';
		  }
        echo '</div>';
		}
	 // statement ($stmt) afsluttet)
	$stmt->close();
	// luk altid forbindelsen når du ikke har brug for den længere!
	$con->close();
      

?>
    </div>
</body>
</html>

