<!doctype html>
<?php
    header('Content-Type: text/html; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }
		
        $sql = "SELECT scheduleid FROM `schedule` WHERE date = (SELECT MAX(date) FROM schedule)";
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$scheduleid = $row["scheduleid"];
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
        $sql = "SELECT wohnzimmer FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dwohnzimmer = $row["wohnzimmer"];
		}
        $sql = "SELECT kueche FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dkueche = $row["kueche"];
		}
        $sql = "SELECT bad FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dbad = $row["bad"];
		}
        $sql = "SELECT toiletten FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dtoiletten = $row["toiletten"];
		}
        $sql = "SELECT keller FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dkeller = $row["keller"];
		}
        $sql = "SELECT treppenhaus FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dtreppenhaus = $row["treppenhaus"];
		}
        $sql = "SELECT muell FROM done WHERE scheduleid =".(string)$scheduleid;
        $result = $mysqli->query($sql);
		while ($row = $result->fetch_assoc()) {
			$dmuell = $row["muell"];
		}
        $mysqli->close();
		
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
		      <tr>
		        <td><?php echo done($dbad); ?></td>
		        <td><?php echo done($dkueche); ?></td>
				<td><?php echo done($dkeller); ?></td>
				<td><?php echo done($dmuell); ?></td>
				<td><?php echo done($dtoiletten); ?></td>
				<td><?php echo done($dtreppenhaus); ?></td>
				<td><?php echo done($dwohnzimmer); ?></td>
		      </tr>
		    </tbody>
		  </table>
		</div>
		
        <form action="done.php" method="post">
            <h2>Ich habe eine Aufgabe erledigt:</h2>
            <div class="mb-3">
                <label>Erledigte Aufgabe:</label>
                <select class="custom-select" name="location">
                    <option>bad</option>
                    <option>kueche</option>
                    <option>keller</option>
					<option>muell</option>
					<option>toiletten</option>
					<option>treppenhaus</option>
					<option>wohnzimmer</option>
                </select>
            </div>
			<br>
	        <button class="btn btn-primary btn-lg mb-3" type="submit">Als erledigt markieren</button>
	    </form>
		<br>
        <form action="undone.php" method="post">
            <h2>Jemand hat seine Aufgabe nicht richtig erledigt?:</h2>
            <div class="mb-3">
                <label>Betroffener Bereich:</label>
                <select class="custom-select" name="location">
                    <option>bad</option>
                    <option>kueche</option>
                    <option>keller</option>
					<option>muell</option>
					<option>toiletten</option>
					<option>treppenhaus</option>
					<option>wohnzimmer</option>
                </select>
            </div>
			<br>
	        <button class="btn btn-primary btn-lg mb-3" type="submit">Meckern</button>
	    </form>
		
    </body>
</html>