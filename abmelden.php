<?php
	header('Content-Type: text/plain; charset=utf-8');
	
    $mysqli = new mysqli("localhost", "user", "pass", "putzplan");
	$mysqli->set_charset("utf8");

    if ($mysqli->connect_errno) {
        die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
    }    
	
	$name = $_POST["name"];
	
	$sql = "UPDATE person SET active = 0 WHERE name = '".$name."'";
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare($sql)) {
        $OK = $stmt->execute();
		$last = $mysqli->insert_id;
        
		if ($OK) {
            $adresse_id = $mysqli->insert_id;
            echo "Erfolgreich für die nächste Woche abgemeldet\r\n";
        } else {
            echo $stmt->error . "\r\n";
        }
    }
    $mysqli->close();
    
?>
	