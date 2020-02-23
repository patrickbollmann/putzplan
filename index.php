<!doctype html>
<?php
    header('Content-Type: text/html; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }

		
		function done($x)
		{
		    if ($x==1){
				return ✅;
			}if ($x==2){
				return ⚠️;
			}else{
				return ❌;
			}
		}
		$abgemeldet = " ";
		$sql = "SELECT name FROM person WHERE active = 0";
		$result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()){
			$abgemeldet = $abgemeldet.$row["name"].", ";
		}
		$abgemeldet = substr($abgemeldet, 0, -2); //komma und Leer am ende entfernen

		

?>

<html lang="de">

    <head>
        <meta charset="utf-8">
        <title>Putzplan</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
	
    <body>
		
		<div class="container">
		  <h2>Putzplan</h2>   
		  <div class="table-responsive">       
		  <table class="table">
		    <thead>
		      <tr>
			  
			<?php
			  $sql = "SELECT Name FROM location";
			  $result = $mysqli->query($sql);
			  while ($row = $result->fetch_assoc()):
				  ?>

				<th><?php echo $row["Name"]; ?></th>
				

			  <?php endwhile; ?>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <?php
			  $sql = "SELECT User FROM location";
			  $result = $mysqli->query($sql);
			  while ($row = $result->fetch_assoc()):
				  ?>
				<td><?php echo $row["User"]; ?></td>
				<?php endwhile; ?>
			  </tr>
			  <tr>
		        <?php
			  $sql = "SELECT Done, Beschwerde FROM location";
			  $result = $mysqli->query($sql);
			  while ($row = $result->fetch_assoc()):
				  ?>
				<td><?php echo done($row["Done"]); echo $row["Beschwerde"];?></td>
				<?php endwhile; ?>
		      </tr>
		    </tbody>
		  </table>
		</div>
		<br>
		Für die nächste Woche abgemeldet sind: <h6><?php echo $abgemeldet; ?></h6>
		<br>
		<div class ="row">
		<div class="col-md-6 col-12 mb-3">
        <form action="done.php" method="post">
            <h2>Ich habe eine Aufgabe erledigt:</h2>
            <br>
                <label>Erledigte Aufgabe:</label>
                <select class="custom-select" name="location">
		        <?php
			  $sql = "SELECT Name FROM location";
			  $result = $mysqli->query($sql);
			  while ($row = $result->fetch_assoc()):
				  ?>
				<option><?php echo $row["Name"]; ?></option>
				<?php endwhile; ?>
				</select>
				

			<br><br>
	        <button class="btn btn-primary btn-lg mb-3" type="submit">Als erledigt markieren</button>
	    </form>
		<br>
        <form action="abmelden.php" method="post">
            <h2>Ich möchte mich für die nächste Woche abmelden:</h2>
                <label>Name wählen:</label>
                <select class="custom-select" name="name">
					<?php
			        $sql  = 'SELECT name FROM person';
			        $result = $mysqli->query($sql);
			  		while ($row = $result->fetch_assoc()) {
					  echo "<option>".$row["name"]."</option>";
			  		}
					?>
                </select>
			<br><br>
	        <button class="btn btn-primary btn-lg mb-3" type="submit">Abmelden</button>
	    </form>
		</div>
		<div class="col-md-6 col-12 mb-3">
        <form action="undone.php" method="post">
            <h2>Jemand hat seine Aufgabe nicht richtig erledigt?:</h2>
                <label>Betroffener Bereich:</label>
                <select class="custom-select" name="location">
				<?php
				$sql = "SELECT Name FROM location";
			  $result = $mysqli->query($sql);
			  while ($row = $result->fetch_assoc()):
				  ?>
				<option><?php echo $row["Name"]; ?></option>
				<?php endwhile; ?>
                </select>
				<br>
				<label>Anmerkung:</label> <input class="form-control" name="anmerkung" type="text">
				<br>
	        	<button class="btn btn-primary btn-lg mb-3" type="submit">Meckern</button>
	    </form>
		</div>
	</div>
		<br>
        
		<br>
		<a href="PutzHinweise.pdf">Allgemeine Hinweise zum putzen</a> 
		
    </body>
</html>