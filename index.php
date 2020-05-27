<!doctype html>
<?php
header('Content-Type: text/html; charset=utf-8');

include "../secret/secret.php";
$mysqli = new mysqli("localhost", $dbuser, $dbpass, "putzplan");
$mysqli->set_charset("utf8");

if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}


function done($x)
{
	if ($x == 1) {
		return ✅;
	}
	if ($x == 2) {
		return ⚠️;
	} else {
		return ❌;
	}
}
$abgemeldet = " ";
$sql = "SELECT name FROM person WHERE active < 1";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
	$abgemeldet = $abgemeldet . $row["name"] . ", ";
}
$abgemeldet = substr($abgemeldet, 0, -2); //komma und Leer am ende entfernen



?>

<html lang="de">

<head>
	<meta charset="utf-8">
	<title>Putzplan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

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
						while ($row = $result->fetch_assoc()) :
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
						while ($row = $result->fetch_assoc()) :
						?>
							<td><?php echo $row["User"]; ?></td>
						<?php endwhile; ?>
					</tr>
					<tr>
						<?php
						$sql = "SELECT Done, Beschwerde FROM location";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc()) :
						?>
							<td><?php echo done($row["Done"]);
								echo $row["Beschwerde"]; ?></td>
						<?php endwhile; ?>
					</tr>
				</tbody>
			</table>
		</div>
		<br>
		Für die nächste Woche abgemeldet sind: <h6><?php echo $abgemeldet; ?></h6>
		<br>
		<div class="row">
			<div class="col-md-6 col-12 mb-3">
				<form action="done.php" method="post">
					<h2>Ich habe eine Aufgabe erledigt:</h2>
					<br>
					<label>Erledigte Aufgabe:</label>
					<select class="custom-select" name="location">
						<option></option>
						<?php
						$sql = "SELECT Name FROM location";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc()) :
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
						<option></option>
						<?php
						$sql  = 'SELECT name FROM person';
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc()) {
							echo "<option>" . $row["name"] . "</option>";
						}
						?>
					</select>
					<label>Wie lange möchtest du dich abmelden?</label>
					<select class="custom-select" name="amount">
						<option>Eine Woche</option>
						<option>Zwei Wochen</option>
						<option>Drei Wochen</option>
						<option>Vier Wochen</option>
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
						<option></option>
						<?php
						$sql = "SELECT Name FROM location";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc()) :
						?>
							<option><?php echo $row["Name"]; ?></option>
						<?php endwhile; ?>
					</select>
					<br>
					<label>Anmerkung:</label> <input class="form-control" name="anmerkung" type="text">
					<br>
					<button class="btn btn-primary btn-lg mb-3" type="submit">Meckern</button>
				</form>
				<form action="abbauen.php" method="post">
					<h2>Ich möchte eine Strafe abarbeiten..</h2>
					<label>Name:</label>
					<select class="custom-select" name="location">
						<option></option>
						<?php
						$sql = "SELECT Name FROM person";
						$result = $mysqli->query($sql);
						while ($row = $result->fetch_assoc()) :
						?>
							<option><?php echo $row["Name"]; ?></option>
						<?php endwhile; ?>
					</select>
					<br>
					<label>Welche Zusatzaufgabe möchtest du machen?</label>
					<select class="custom-select" name="amount">
						<option></option>
						<option>Backofen</option>
						<option>Keller</option>
						<option>Terrasse</option>
						<option>Party aufgeräumt</option>
					</select>
					<br><br>
					<button class="btn btn-primary btn-lg mb-3" type="submit">Strafen abbauen</button>
				</form>
			</div>
		</div>
	</div>
	<br>

	<br>
	<a href="PutzHinweise.pdf">Allgemeine Hinweise zum putzen</a>

</body>

</html>