<?php
echo "test";
	header('Content-Type: text/plain; charset=utf-8');
	
    include "../secret/secret.php";
$mysqli = new mysqli("localhost", $dbuser, $dbpass, "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }
    
    $location = $_POST["location"];
	$anmerkung = $_POST["anmerkung"];
	
	// update anmerkungen
    $sql = "UPDATE location SET Done = 2, Beschwerde = '".$anmerkung."' WHERE Name = '".$location."'";
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare($sql)) {
        $OK = $stmt->execute();
		$last = $mysqli->insert_id;
        
		if ($OK) {
            $adresse_id = $mysqli->insert_id;
            echo "Erfolg\r\n";
			header('Location: https://patrickbollmann.de/putzplan/');
        } else {
            echo $stmt->error . "\r\n";
        }
    }

        $mysqli->close();
    
?>