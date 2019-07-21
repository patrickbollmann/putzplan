<!doctype html>
<?php
    header('Content-Type: text/html; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }

        $sql = "SELECT name FROM person WHERE personid = (SELECT wohnzimmer FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$wohnzimmer = $row["name"];
		}
        $sql = "SELECT name FROM person WHERE personid = (SELECT kueche FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$kueche = $row["name"];
		}
        $sql = "SELECT name FROM person WHERE personid = (SELECT toiletten FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$toiletten = $row["name"];
		}
        $sql = "SELECT name FROM person WHERE personid = (SELECT treppenhaus FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$treppenhaus = $row["name"];
		}
        $sql = "SELECT name FROM person WHERE personid = (SELECT bad FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$bad = $row["name"];
		}
        $sql = "SELECT name FROM person WHERE personid = (SELECT keller FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$keller = $row["name"];
		}
        $sql = "SELECT name FROM person WHERE personid = (SELECT muell FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule))"; //hole aktuellen Putzplan
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$muell = $row["name"];
		}
        $mysqli->close();
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
		        <th>Bad</th>
		        <th>Küche</th>
		        <th>Keller</th>
				<th>Müll</th>
				<th>Toiletten</th>
				<th>Treppenhaus</th>
				<th>Wohnzimmer</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <td><?php echo $bad; ?></td>
		        <td><?php echo $kueche; ?></td>
		        <td><?php echo $keller; ?></td>
		        <td><?php echo $muell; ?></td>
		        <td><?php echo $toiletten; ?></td>
		        <td><?php echo $treppenhaus; ?></td>
		        <td><?php echo $wohnzimmer; ?></td>
		      </tr>
		    </tbody>
		  </table>
		</div>
		
    </body>
</html>